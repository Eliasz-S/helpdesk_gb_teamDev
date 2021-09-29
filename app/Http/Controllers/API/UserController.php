<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdate;
use App\Models\Team;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('userRole')
            ->with('team')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($users as $user) {
            $user->oldTeamList = $user->team;
        } // сохраняем предыдущее состояние списка команд для дальнейшей проверки

        $roles = UserRole::all();
        $teams = Team::all();

        return [
            'users' => $users,
            'roles' => $roles,
            'teams' => $teams
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'user_role_id' => $request->get('user_role_id')
        ]);

        $user->save();

        $user->team()->attach($request->get('team'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->user_role_id = $request->get('user_role_id');
        $user->is_enabled = $request->get('is_enabled');

        if ($request->get('team') !== $request->get('oldTeamList')) {

            \DB::select("delete from user_teams where user_id = {$user->id}");

            $user->team()->attach($request->get('team'));

        } // проверяем, совпадает ли список групп пользователя с тем, что было до этого. 
          // Если да - не трогаем таблицу user_teams (с соответствиями юзеров и команд) 
          // Иначе группы (которые мы выбрали ранее) по данному пользователю затираются всегда, а новые записи мы не передаем, 
          // в результате чего пользователь остается без групп вообще.

        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
