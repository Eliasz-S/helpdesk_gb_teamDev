<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\TicketCreate;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getUserRole()
    {
        $userRole = \Auth::user()->load('userRole')->userRole->code;
        return $userRole;
    }
    public function index()
    {
        return view('admin.index', [
            'userRole' => $this->getUserRole()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tickets.create', [
            'userRole' => $this->getUserRole()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketCreate $request)
    {
        $user = new User();
        $ticket = new Ticket();

        $data = $request->validated();

        $checkUser = User::where('email', $data['email'])->first(); // Check if isset account yet

        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $hashed_random_password = Hash::make(substr($random, 0, 8));

        if (!$checkUser) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = $hashed_random_password;
            $user->is_enabled = 1;
            $user->user_role_id = 4;
            $statusSave = $user->save();
            //TODO: Send users a password reset

        } // if account not isset we create it

        $checkUser = User::where('email', $data['email'])->first();
        $userID = $checkUser->id;

        $ticket->customer_id = $userID;
        $ticket->type_id = $data['type_id'];
        $ticket->priority_id = $data['priority_id'];
        $ticket->status_id = '1'; //status 'free'
        $ticket->subject = $data['subject'];

        if ($ticket->save()) {
            $message = new Message();

            $message->ticket_id = $ticket->id;
            $message->user_id = $userID;
            $message->message = $data['message'];
            $message->created_by = 'customer';

            $statusSave = $message->save();
        }

        if (!empty($statusSave)) {
            return redirect()->route('admin.tickets.create')
                ->with('success', __('Successfully created'));
        }
        return back()->with('error', __('Error'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
