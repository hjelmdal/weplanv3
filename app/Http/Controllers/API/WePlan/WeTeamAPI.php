<?php

namespace App\Http\Controllers\API\WePlan;

use App\Models\WePlan\WeTeam;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeTeamAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = WeTeam::all();
        $teams->load("players", "players.user");
        return response()->json(["data" => $teams],200);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation());

        if($request->active == "on") {
            $active = 1;
        } else {
            $active = 0;
        }


        $team = WeTeam::updateOrCreate(
            ["id" => $request->id],
            [
                "name" => $request->name,
                "max_players" => $request->max_players,
                "active" => $active
            ]
        );
        if($team->wasRecentlyCreated) {
            $status = 201;
        } else {
            $status = 200;
        }

        return response()->json(["team" => $team,"message" => "Truppen er oprettet!"],$status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $team = WeTeam::findOrFail($id);
            $team->load("players");
        } catch (ModelNotFoundException $e) {
            return response()->json("Team not found", 404);
        }
        return $team;
    }

    public function players($id)
    {
        try {
            $team = WeTeam::findOrFail($id);
            $team->load("players");
        } catch (ModelNotFoundException $e) {
            return response()->json("Team not found", 404);
        }
        if(!$team->players) {
            return response()->json("No players found", 404);

        }
        return response()->json(["data" => $team->players]);
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
        $request->validate($this->validation());
        if($request->id != $id) {
            return response()->json(["message" => "Bad request or ID"],400);
        }

        try {
            $team = WeTeam::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(["message" => "Team not found" ], 404);
        }
        $team->name = $request->name;
        $team->max_players = $request->max_players;
        if($request->active) {
            $team->active = 1;
        } else {
            $team->active = 0;
        }
        //$team->owner_id = $request->owner_id;
        $team->save();

        return response()->json(["message" => "Team is updated"],200);

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

    private function validation() {
        return [
            "name" => "required|string|min:3|max:50",
            "max_players" => "required|integer|min:0|max:1000"];
    }
}
