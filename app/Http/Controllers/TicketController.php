<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function show($id)
    {
        return response()->json(Ticket::pimp()->find($id));
    }

    public function user($user_id) 
    {
        return response()->json(Ticket::pimp()->find(['user_id' => $user_id]));
    }
}
