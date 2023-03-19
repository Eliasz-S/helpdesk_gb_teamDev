<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LeadTeam;
use Illuminate\Http\Request;
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = \DB::select('
            select
                t.id, t.name, t.description
                ,lt.user_id
                ,u.name        teamLead
            from
                teams                   t
                left join lead_teams    lt  on  lt.team_id = t.id
                left join users          u   on  u.id = lt.user_id
            order by id
        ');

        $users = \DB::select('
            select
                ut.team_id
                ,u.id, u.name
            from
                user_teams      ut
                join users      u  on  u.id = ut.user_id
            order by team_id
        ');

        return [
            'teams' => $team,
            'users' => $users,
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
        $team = new Team([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        $team->save();

        $lead = new LeadTeam([
            'team_id' => $team->id,
            'user_id' => $request->get('user_id')
        ]);

        $lead->save();
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
    public function update(Request $request, Team $team)
    {
        $team->name = $request->get('name');
        $team->description = $request->get('description');

        $user_id = $request->get('user_id');

        if (empty($user_id)) { // user не выбран
            \DB::table('lead_teams')
                ->where('team_id', '=', $team->id)
                ->delete();
        } else {
            $leadTeam = \DB::table('lead_teams')->where('team_id', '=', $team->id)->get();

            if ( empty($leadTeam[0]) ) { // нет назначения user_id для team_id в таблице lead_teams
                \DB::table('lead_teams')->insert([
                    'team_id' => $team->id
                    ,'user_id' => $user_id
                ]);
            } elseif ($leadTeam[0]->user_id != $user_id) { // ранее уже было назначение и выбран новый user_id
                \DB::table('lead_teams')
                    ->where('team_id', '=', $team->id)
                    ->update(['user_id' => $user_id]);
            }
        }

        $team->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Team::find($id)->delete();
    }
}
