<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
//        $user = \Auth::user()->load('userRole');
//
//        return view('admin.profile.index', [
//            'userRole' => $user->userRole->code
//        ]);
    }

    public function account()
    {
        $userAuth = \Auth::user()->load('userRole');
        $id = \Auth::user()->id;

        $user = User::join('user_roles', 'users.user_role_id', '=', 'user_roles.id')
            ->find($id);

        return view('admin.profile.account', [
            'userRole' => $userAuth->userRole->code,
            'user' => $user
        ]);
    }
}
