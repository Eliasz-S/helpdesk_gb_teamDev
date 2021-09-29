<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerUser;
use App\Models\Ticket;
use App\Models\Message;
use App\Models\StaffUser;
use App\Models\TicketPriority;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::with('ticketStatus')
            ->with('ticketPriority')
            ->with('customerUser')
            ->with('ticketType')
            ->with('staffUser')
            ->with('message')
            ->orderBy('id', 'desc')
            ->get();

        $status = TicketStatus::all();
        $priority = TicketPriority::all();
        $customerUser = User::where('user_role_id', '4')->get();
        $staffUser = User::where('user_role_id', '1')->orWhere('user_role_id', '2')->orWhere('user_role_id', '3')->get();
        $type = TicketType::all();
        $message = Message::all();

        return [
            'tickets' => $tickets,
            'status' => $status,
            'priority' => $priority,
            'staff_user' => $staffUser,
            'customer_user' => $customerUser,
            'type' => $type,
            'message' => $message,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$userID = Auth::user()->id;
        $userID = $request->get('staff_id');
        $staffUserID = $request->get('staff_id');

        $ticket = new Ticket([
            'subject' => $request->get('subject'),
            'status_id' => $request->get('status_id'),
            'priority_id' => $request->get('priority_id'),
            'type_id' => $request->get('type_id'),
            'staff_id' => $staffUserID,
            'customer_id' => $userID,
        ]);

        $ticket->save();

        if ($request->get('message')) {
            $message = new Message();

            $staff = User::where('id', $staffUserID)->first();
            $roleID = $staff->user_role_id;
            $role = UserRole::where('id', $roleID)->first();
            $roleName = $role->description;

            $lastTicket = Ticket::latest()->first();
            $ticketID = $lastTicket->id;

            $message->ticket_id = $ticketID;
            $message->user_id = $userID;
            $message->message = $request->get('message');
            $message->created_by = $roleName;

            $message->save();
        }
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
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->status_id = $request->get('status_id');
        $ticket->priority_id = $request->get('priority_id');
        $ticket->type_id = $request->get('type_id');
        $ticket->staff_id = $request->get('staff_id');

        $ticket->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Ticket::find($id)->delete();
    }
}
