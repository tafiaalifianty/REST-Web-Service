<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = Order::pimp()->find($id);
        if (!$order) {
            return response()->json([
                'status' => 200,
                'message' => "Transaksi tidak ditemukan"
            ], 404);    
        }

        return response()->json([
            'status' => 200,
            'data' => $order
        ], 200);
    }

    public function store(Request $request, $user_id)
    {
        $validator = Validator::make($request->all(), [
            'bus_name' => 'required|string',
            'ticket_amount' => 'required|numeric',
            'seat_position' => 'required|string',
            'departure_city' => 'required|string',
            'departure_bus_station' => 'required|string',
            'departure_date' => 'required',
            'arrived_city' => 'required|string',
            'arrived_bus_station' => 'required|string',
            'arrived_date' => 'required',
            'total_price' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->errors()
            ], 400);
        }

        DB::beginTransaction();
        
        try {
            $order = Order::create(array_merge($request->only(['total_price']), ['user_id' => $user_id]));
            $order->snapshot()->create(array_merge($request->except(['total_price'])));
            
            DB::commit();
            
            return response()->json([
                'status' => 200,
                'data' => Order::with('snapshot')->find($order->id)
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'Internal server error'
            ], 500);
        }
    }
}
