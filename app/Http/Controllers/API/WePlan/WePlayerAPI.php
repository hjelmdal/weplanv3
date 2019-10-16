<?php

namespace App\Http\Controllers\API\WePlan;

use App\Models\WePlan\WePlayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WePlayerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $players = WePlayer::orderBy("name")->get();
        } catch (ModelNotFoundException $e) {
            return response()->json("Not found",404);
        }
        $players->load("user","team");
        return response()->json(array("data" => $players));

    }

    public function byTeam()
    {
        $players = WePlayer::orderByRaw('ISNULL(team_id), team_id ASC')->orderBy("gender", "asc")->orderBy("name", "asc")->get();
        $players->load("user","team","BpPlayer");
        return response()->json(array("data" => $players));

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
        try {
            $player = WePlayer::findOrFail($id)->with("user");
        } catch (ModelNotFoundException $e) {
            return response()->json(["errors" => ["form" => "Player not found"]],404);
        }
        return response()->json($player,200);
    }

    public function find($id) {
        try {
            $players = WePlayer::where('dbf_id', 'like', '%' . $id . '%')->with(["user","BpPlayer.BpClub"])->get();
        } catch (ModelNotFoundException $e) {
            return response()->json(["errors" => ["form" => "Player not found"]],404);
        }
        return response()->json($players,200);
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
        if(!$id) {
            return response()->json("Not a valid input!" . $id ."aay",400);
        }

        try {
            $player = WePlayer::findOrFail($id);
            if (request()->has('name')) {
                $player->name = $request->name;
            }
            if (request()->has('gender')) {
                $player->gender = $request->gender;
            }
            if (request()->has('team')) {
                if($request->team == 0) {
                    $player->team_id = null;
                } else {
                    $player->team_id = $request->team;
                }
            }
            $player->save();
            return response()->json($player->name ." blev opdateret!",200);

        } catch (ModelNotFoundException $e) {
            return response()->json("Not found!",404);
        }
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
