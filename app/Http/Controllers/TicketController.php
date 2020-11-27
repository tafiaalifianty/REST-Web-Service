<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show($id)
    {
        $ticket = Ticket::pimp()->find($id);
        if (!$ticket) {
            return response()->json([
                'status' => 200,
                'message' => "Tiket tidak ditemukan"
            ], 404);    
        }

        return response()->json([
            'status' => 200,
            'data' => $ticket
        ], 200);
    }

    public function user($user_id) 
    {
        $tickets = Ticket::pimp()->where(['user_id' => $user_id])->get();
        if (!$tickets or count($tickets) < 1) {
            return response()->json([
                'status' => 200,
                'message' => "Tiket tidak ditemukan pada user ID: ". $user_id
            ], 404);    
        }

        return response()->json([
            'status' => 200,
            'data' => $tickets
        ], 200);
    }
}
