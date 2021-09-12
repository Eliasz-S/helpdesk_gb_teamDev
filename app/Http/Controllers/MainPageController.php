<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\TicketCreate;

class MainPageController extends Controller
{
    public function index()
    {
        return view('main');
    }
}
