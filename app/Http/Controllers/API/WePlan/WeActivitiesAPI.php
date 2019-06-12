<?php

namespace App\Http\Controllers\API\WePlan;

use App\Http\Controllers\API\Auth\AuthController;
use App\Models\WePlan\WeActivity;
use App\Models\WePlan\WeActivityType;
use App\Models\WePlan\WeDecline;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Input;

class WeActivitiesAPI extends Controller
{
    private $user;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct() {

    }

    public function index() {
        //
    }

    /**
     * Display a listing of the resource.
     * @param string
     * @return \Illuminate\Http\Response
     */
    public function get($date = null, Request $request)
    {
        $user = $request->get('user');
        if($user->WePlayer) {
            $player_id = $user->WePlayer->id;
        } else {
            $player_id = false;
        }
        if($date == null) {
            $date = date("Y-m-d");
        }
        $dateObj = new \DateTime($date);
        $dayOfWeek = $dateObj->format("w");
        if($dayOfWeek == 1) {
            $dateObj->modify('This Monday');
        } else {
            $dateObj->modify('Last Monday');
        }

        $date = $dateObj->format("Y-m-d");
        $weektime = strtotime($date);
        $greater = date("Y-m-d",$weektime);
        $less = date("Y-m-d",$weektime + 604800);
        try {
            $activities = WeActivity::where("start_date", ">=", $greater)->where("start_date", "<", $less)->orderBy("start_date","ASC")->orderBy("start","ASC")->get();
            $activities->load("type","players");
            foreach ($activities as $activity) {
                $activity->my_activity = false;
                $activity->confirmed = 0;
                $activity->declined = 0;
                $activity->enrolled = count($activity->players);
                if($activity->enrolled > 0) {
                foreach ($activity->players as $player) {
                    if ($player->id === $player_id) {
                        $activity->my_activity = true;
                        if($player->pivot->confirmed_at) {
                            $activity->my_status = 2;
                        } elseif($player->pivot->declined_at) {
                            $activity->my_status = 0;
                        } else {
                            $activity->my_status = 1;
                        }

                    }
                    if($player->pivot->confirmed_at) {
                        $activity->confirmed++;
                    }
                    if($player->pivot->declined_at) {
                        $activity->declined++;
                    }
                }
                }
            }
        } catch (ModelNotFoundException $e) {
            return response()->json("No activities found", 404);
        }
        $data = $activities;
        $types = WeActivityType::all();

        $next_week = date("Y-m-d",$weektime+604800);
        $prev_week = date("Y-m-d",$weektime-604800);
        $this_week_url = route("api.v1.activities.get",["date" => date("Y-m-d",$weektime)]);
        $next_week_url = route("api.v1.activities.get",["date" => $next_week]);
        $prev_week_url = route("api.v1.activities.get",["date" => $prev_week]);

        $start_date = $dateObj->format("Y-m-d");
        $end_date = $dateObj->modify("+6 days")->format("Y-m-d");
        return response()->json(array("user" => $this->user,"types" => $types, "data" => $data, "total" => 100, "to" => 4, "from" => 0,"this_week_url" => $this_week_url, "next_week_url" => $next_week_url, "prev_week_url" => $prev_week_url, "start_date" => $start_date, "end_date" => $end_date, "next_week" => $next_week, "prev_week" => $prev_week));
        //$activities = WeActivity::paginate(4);
        //$activities->load("");


        return $activities;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enroll(Request $request) {
        $action = "";
        $input = $request->only("player_id", "activity_id");
        try {
            $activity = WeActivity::findOrFail($request->activity_id);
        } catch (ModelNotFoundException $e) {
            return response()->json("Bad input!", 400);
        }
        if($activity->players->contains($request->player_id)) {
            $activity->players()->detach($request->player_id, ["activity_id" => $request->activity_id]);
            $action = "dissociated";
        } else {
            $activity->players()->attach($request->player_id, ["activity_id" => $request->activity_id]);
            $action = "associated";
        }
        $activity->save();
        return response()->json("Player is " . $action . " OK", 200);
    }
    /**
     * Confirm the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $user = $request->get('user'); // Get user from Middleware
        if($user->WePlayer) {
            $player_id = $user->WePlayer->id;
        } else {
            return response()->json("Ingen spiller associeret", 404);
        }
        $my_activity = false;
        foreach ($request->players as $p) {
            if ($p["id"] === $player_id) {
                $my_activity = true;
            }
        }
        if ($my_activity) {
            try {
                $activity = WeActivity::findOrFail($request->activity_id);

            } catch (ModelNotFoundException $e) {
                $activity = false;
                return response()->json(array("error" => "Activity not found!"), 404);
            }
            if ($activity) {
                $player_id = $user->WePlayer->id;
                $activity->players()->sync([
                    $player_id => ['confirmed_at' => Carbon::now(), 'declined_at' => NULL]
                ],false);
                $code = 201;
                $activity->save();
                if (1 == 1) {
                    try {
                        $decline = WeDecline::where('training_id', $request->activity_id)->firstOrFail();
                        $decline->delete();
                        $code = 204;
                    } catch (ModelNotFoundException $e) {
                        $code = 200;
                    }
                }
                //Logging::insert("confirmTraining",$input);


                return response()->json($request, $code);

            }


        }

    }

    /**
     * Decline the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request) {
        $user = $request->get('user'); // Get user from Middleware
        if($user->WePlayer) {
            $player_id = $user->WePlayer->id;
        } else {
            return response()->json("Ingen spiller associeret", 404);
        }
        $my_activity = false;
        foreach ($request["players"] as $p) {
            if ($p["id"] === $player_id) {
                $my_activity = true;
            }
        }
        if ($my_activity) {
            try {
                $activity = WeActivity::findOrFail($request->activity_id);

            } catch (ModelNotFoundException $e) {
                $activity = false;
                return response()->json(array("error" => "Activity not found!"), 404);
            }
            if ($activity) {
                $decline = WeDecline::firstOrNew(array('training_id' => $request->activity_id,'player_id' => $player_id));
                if ($decline->exists) {
                    $statusCode = 200;
                } else {
                    $statusCode = 201;
                }
                $decline->start_date = $activity->start_date;
                $decline->end_date = $activity->end_date;
                $decline->training_id = $activity->id;
                $decline->category_id = $request->category;
                $decline->description = $request->description;
                $decline->player_id = $player_id;
                $decline->save();
                //$input["decline_id"] = $decline->id;
                //Training update
                $activity->players()->sync([
                    $player_id => ['declined_at' => Carbon::now(), 'confirmed_at' => NULL]
                ],false);
                $activity->save();
                //Logging::insert("declineTraining",$input);
                return response()->json($request, $statusCode);

            }

        }
        return Response::json(array("error" => "Bad request!"), 400, array("header" => "Bad Request"));

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
        if($id) {
            try {
                $activity = WeActivity::findOrFail($id);
                return $activity;
            } catch (ModelNotFoundException $e) {
                return response()->json("Not found",404);
            }
        } else {
            return response()->json("Bad request",400);
        }
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
