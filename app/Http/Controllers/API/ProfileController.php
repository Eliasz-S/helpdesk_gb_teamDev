<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $userId)
    {
        $user = \DB::table('users')
            ->join('user_roles','user_roles.id','=','users.user_role_id')
            ->where('users.id','=',$userId)
            ->select('users.name','users.email','users.email_verified_at','users.first_name','users.last_name','user_roles.description')
            ->get();

        return $user[0];
    }

}
