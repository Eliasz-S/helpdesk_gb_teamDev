<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketType as ModelTicketType;

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \DB::select('
            select id, code, description, is_active
            from ticket_types
        ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $row = new ModelTicketType([
            'code' => $request->get('code'),
            'description' => $request->get('description'),
            'is_active' => $request->get('is_active'),
        ]);

        $row->save();
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
    public function update(Request $request, ModelTicketType $ticketType)
    {
        $ticketType->code = $request->get('code');
        $ticketType->description = $request->get('description');
        $ticketType->is_active = $request->get('is_active');

        $ticketType->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ModelTicketType::find($id)->delete();
    }
}
