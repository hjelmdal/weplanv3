<?php

namespace App\Http\Controllers\API\BadmintonPeople;

use App\Models\BadmintonPeople\BpPlayer;
use App\Models\WePlan\WePlayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BpPlayerAPI extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = BpPlayer::where("club_id","1622")->orderBy("name","asc")->get();
        $players->load("WePlayer");

        return response()->json(array("data" => $players));

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
        $request->validate([
            "data.*" => "required|integer|min:1|distinct",
        ]);

            $data = $request["data"];
        if(!$data) {
            return response()->json(["message" => "Ingen spillere valgt!"], 404);
        }

        $length = count($data);

        foreach($data as $pId) {
            try {
                $pl = BpPlayer::findOrFail($pId);
            } catch (ModelNotFoundException $e) {
                $message = "Spiller id ikke fundet: ". $pId;
                return response()->json(["message" => $message], 404);

            }
            WePlayer::updateOrCreate(["dbf_id" => $pl->dbf_id],["name" => $pl->name, "dbf_id" => $pl->dbf_id, "gender" => $pl->gender, "birthday" => $pl->birthday]);

        }
        $player = "spiller";
        if($length > 1) {
            $player .= "e";
        }
        $message = $length . " " . $player . " blev oprettet!";
        return response()->json(["data" => $request["data"], "message" => $message],200);
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
    
    public function checkPlayer(Request $request) {
        if($request->playerId) {
            try {
                $player = BpPlayer::where("dbf_id", $request->playerId)->firstOrFail();
                $player->load("BpClub");
            } catch (ModelNotFoundException $e) {
                return response()->json(["errors" => ["form" => [0 => "Spilleren blev ikke fundet i vores system"]]],404);
            }
            
            return response()->json(["player" => $player],200);
            
        }
        return response()->json(["errors" => "Bad request"],400);
    }
}
