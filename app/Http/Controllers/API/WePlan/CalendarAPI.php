<?php

namespace App\Http\Controllers\API\WePlan;

use App\Models\WePlan\WeActivity;
use App\Models\WePlan\WePlayer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function plan($date)
    {
        $players = WePlayer::orderByRaw('ISNULL(team_id), team_id ASC')->orderBy("gender","asc")->orderBy("name","asc")->get();
        $players->load("activities","team","declines","user");
        $activities = WeActivity::where("start_date",$date)->orderBy("start","asc")->get();
        $activities->load("type");
        $dateObj = new \DateTime($date);
        $today = $dateObj->format("Y-m-d");
        $yesterday = $dateObj->modify("- 1day")->format("Y-m-d");
        $tomorrow = $dateObj->modify("+ 2days")->format("Y-m-d");
        $data = ["today" => $today, "yesterday" => $yesterday, "tomorrow" => $tomorrow];
        return response()->json(["data" => $data, "players" => $players, "activities" => $activities],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
