<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }

    public function store(Request $request, $order_id)
    {
        $validator = Validator::make($request->all(), [
            'payment_amount' => 'required|numeric',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bank_name' => 'required|string',
            'bank_account' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'messages' => $validator->errors()
            ], 400);
        }

        $order = Order::with('snapshot')->find($order_id);
        if (!$order) {
            return response()->json([
                'status' => 404,
                'message' => 'Transaksi tidak ditemukan'
            ], 404);
        }

        if ($order->status === 'settled') {
            return response()->json([
                'status' => 400,
                'message' => 'Transaksi sudah dibayarkan pada tanggal '. $order->updated_at->format('d M Y H:i:s')
            ], 400);
        }

        if ($order->total_price != $request->payment_amount) {
            return response()->json([
                'status' => 400,
                'message' => 'Jumlah pembayaran tidak sesuai'
            ], 400);
        }

        DB::beginTransaction();

        try {
            $main_url = env('APP_ENV') == 'production' ? env('APP_URL') : env('APP_URL').':8000';
            $image_path = 'images';
            $image_name = $this->uuid->toString() .'.'. $request->payment_proof->extension();
            $image_url = $main_url .'/'. $image_path .'/'. $image_name;

            $payment = Payment::create(array_merge($validator->validated(), [
                'user_id' => auth()->user()->id,
                'order_id' => $order_id,
                'payment_proof' => $image_url
            ]));

            if ($payment) {
                $order->status = 'settled';
                $order->save();

                $snapshot = $order->snapshot->toArray();
                unset($snapshot['id']);
                unset($snapshot['created_at']);
                unset($snapshot['updated_at']);
                
                Ticket::create(array_merge($snapshot, [
                    'user_id' => auth()->user()->id,
                    'order_id' => $order_id   
                ]));
            }

            DB::commit();

            $request->payment_proof->move(public_path('images'), $image_name);

            return response()->json([
                'status' => 200,
                'data' => $payment
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
