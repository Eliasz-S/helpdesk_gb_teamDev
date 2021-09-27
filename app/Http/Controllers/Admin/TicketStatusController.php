<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TicketStatusController extends Controller
{
    public function index() {
        return view('layouts.dashboard', [
            'userRole' => UserController::getUserRole()
        ]);
    }
}
