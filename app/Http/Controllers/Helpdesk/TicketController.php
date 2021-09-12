<?php

namespace App\Http\Controllers\Helpdesk;

use App\Models\Message;
use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\TicketCreate;

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
    public function submit(TicketCreate $request)
    {
        $data = $request->validated();

        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->is_enabled = 1;
        $user->user_role_id = 4;

        if ($user->save()) {
            $ticket = new Ticket();

            $ticket->customer_id = $user->id;
            $ticket->type_id = $data['type_id'];
            $ticket->subject = $data['subject'];

            if ($ticket->save()) {
                $message = new Message();

                $message->ticket_id = $ticket->id;
                $message->user_id = $ticket->customer_id;
                $message->created_by = 'customer';  // TODO: лишняя колонка, нужно будет удалить
                $message->message = $data['message'];

                $statusSave = $message->save();
            }
        }

        if (!empty($statusSave)) {
            dd('<h2>Заявка успешно добавлена</h2>');
            return redirect()->route('index')
            ->with('success', __('Successfully created'));
        }
        return back()->with('error', __('Error'));
    }
}
