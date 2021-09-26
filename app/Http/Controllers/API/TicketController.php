<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Message;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::addSelect(['messages' => Message::select('messages')
                ->whereColumn('messages.ticket_id', 'tickets.id')
                ->limit(1)
            ])
            ->leftJoin('users as staff', 'tickets.staff_id', '=', 'staff.id')
            ->join('users as customer', 'tickets.customer_id', '=', 'customer.id')
            ->join('ticket_status', 'tickets.status_id', '=', 'ticket_status.id')
            ->join('ticket_priority', 'tickets.priority_id', '=', 'ticket_priority.id')
            ->select(
                \DB::raw("(SELECT messages.message FROM messages
                    WHERE messages.ticket_id = tickets.id LIMIT 1
                    ) as message"),
                'tickets.id', 'tickets.subject', 'customer.name as customer_name', 'customer.email as customer_email','staff.name as staff_name','staff.email as staff_email', 'ticket_status.description as status', 'ticket_priority.description as priority', 'tickets.created_at')
            ->latest()
            ->paginate(Ticket::count());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
