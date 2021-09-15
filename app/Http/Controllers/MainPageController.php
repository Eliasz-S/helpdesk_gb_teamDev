<?php

namespace App\Http\Controllers;

use App\Models\TicketType;

class MainPageController extends Controller
{
    public function index()
    {
        $ticketType = TicketType::orderBy('id')->get();

        return view('main', [
            'types' => $ticketType
        ]);
    }
}
