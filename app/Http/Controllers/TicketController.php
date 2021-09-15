<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use App\Http\Requests\TicketCreate;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
//    public function index()
//    {
//
//        $tickets = Ticket::orderBy('id','desc')->paginate(3);
//        return view('manager.tickets.index', [
//            'tickets' => $tickets
//        ]);
//    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
      */
    public function submit(TicketCreate $request)
    {
        $data = $request->validated();

        $user = new User();

        $user->id = DB::table('users')->where('email', $data['email'])->value('id');

        if (empty($user->id)) {

            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->is_enabled = 1;
            $user->user_role_id = 4;
            $user->password = md5($data['email']);

            $user->save();
        }

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

        if (!empty($statusSave)) {
            return redirect()->route('main',['#contact'])
                ->with('success', __('Заявка успешно добавлена'));
        }
        return back()->with('error', __('Ой! Что-то пошло не так'));
    }
}
