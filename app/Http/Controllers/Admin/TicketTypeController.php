<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TicketTypeController extends Controller
{
    public function index() {
        return view('admin.index', [
            'userRole' => UserController::getUserRole()
        ]);
    }
}
