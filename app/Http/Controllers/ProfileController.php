<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = \Auth::user()->load('userRole');

        return view('admin.profile.index', [
            'userRole' => $user->userRole->code
        ]);
    }
}
