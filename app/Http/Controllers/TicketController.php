<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * @OA\Get(
     *     path="/ticket/1",
     *     tags={"Ticket"},
     *     summary="Get ticket detail",
     *     description="Get ticket detail",
     *     operationId="ticket/id",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Ticket data",
     *          @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data not found",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Method not allowed (Unauthenticated)",
     *     ),
     *     @OA\Response(
     *        response=500,
     *        description="Internal server error"
     *     )
     * )
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
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

    /**
     * @OA\Get(
     *     path="/ticket/user/1",
     *     tags={"Ticket"},
     *     summary="Get user's ticket",
     *     description="Get user's ticket",
     *     operationId="ticket/user/user_id",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response=200,
     *          description="Ticket data",
     *          @OA\JsonContent(ref="#/components/schemas/Ticket")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data not found",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="Method not allowed (Unauthenticated)",
     *     ),
     *     @OA\Response(
     *        response=500,
     *        description="Internal server error"
     *     )
     * )
     */
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
