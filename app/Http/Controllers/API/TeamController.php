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
            select id, name, description
            from teams
        ');

        $users = \DB::select('
            select id, name
            from users
        ');

        $teamLeads = LeadTeam::with('user')
            ->get();

        return [
            'teams' => $team,
            'users' => $users,
            'teamLeads' => $teamLeads
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

        $team->save();

        $lead_id = $request->get('lead_id');

        if (!empty($lead_id)) { //update
            $lead = LeadTeam::find($lead_id);

            $lead = [
                'team_id' => $team->id,
                'user_id' => $request->get('user_id')
            ];
        } else { //add
            $lead = new LeadTeam([
                'team_id' => $team->id,
                'user_id' => $request->get('user_id')
            ]);
        }

        $lead->save();
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
