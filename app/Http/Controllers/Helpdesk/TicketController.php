<?php

namespace App\Http\Controllers\Helpdesk;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TicketStore;

class TicketController extends Controller
{
    public function index()
    {

        $tickets = Ticket::orderBy('id','desc')->paginate(3);
        return view('manager.tickets.index', [
            'tickets' => $tickets
        ]);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketStore $request, Ticket $ticket)
    {

        $data = $request->validated();

        $statusTicket = $ticket->fill($data)->save();

        if ($statusTicket) {
            return redirect()->route('index')
            ->with('success', __('Successfully created'));
        }
        return back()->with('error', __('Error'));
    }
}
