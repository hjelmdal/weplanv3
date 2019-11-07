<?php

namespace App\Http\Controllers\API\WePlan;

use App\Helpers\CalendarHelper;
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
     * @throws \Exception
     */
    public function get($date = null, $filter = null, Request $request)
    {
        $filter = false;
        $my_filter = false;
        if($request->filters) {
            foreach ($request->filters as $key => $value) {
                if($value == "true") {
                    if($key == 0) {
                        $my_filter = true;
                    } else {
                        $filter[] = $key;
                    }
                }
            }
        }

        $user = $request->get('user');
        $user->load("roles");

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

        if($user->WePlayer) {
            $player_id = $user->WePlayer->id;
            $user->WePlayer->declines = WeDecline::where("start_date",">=",$greater)->where("start_date","<=",$less)->orderBy("start_date","ASC")->get();
        } else {
            $player_id = false;
        }
        try {
            $filterArray = null;
            if($filter) {
                $activities = WeActivity::whereIn("type_id",$filter)->where("start_date", ">=", $greater)->where("start_date", "<", $less)->orderBy("start_date","ASC")->orderBy("start","ASC")->get();
            } else {
                $activities = WeActivity::where("start_date", ">=", $greater)->where("start_date", "<", $less)->orderBy("start_date", "ASC")->orderBy("start", "ASC")->get();
            }
            $activities->load(["type","players","players.user","responsible","responsible.UserInfo"]);
            foreach ($activities as $activity) {
                $activity->my_activity = false;
                $activity->response_timestamp = strtotime($activity->response_date . " " . $activity->response_time);
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
                if($my_filter && $activity->my_activity) {
                    $filterArray[] = $activity;
                }
            }
        } catch (ModelNotFoundException $e) {
            return response()->json("No activities found", 404);
        }
        if($my_filter) {
            $activities = $filterArray;
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
        return response()->json(array("user" => $user,"types" => $types, "data" => $data, "total" => 100, "to" => 4, "from" => 0,"this_week_url" => $this_week_url, "next_week_url" => $next_week_url, "prev_week_url" => $prev_week_url, "start_date" => $start_date, "end_date" => $end_date, "next_week" => $next_week, "prev_week" => $prev_week));

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

        try {
            $activity = WeActivity::findOrFail($request->activity_id);
            $activity->load("type","players");

        } catch (ModelNotFoundException $e) {
            $activity = false;
            return response()->json(array("error" => "Activity not found!"), 404);
        }

        $my_activity = false;
        $code = false;
        foreach ($activity->players as $player) {
            if($player->id == $player_id) {
                $my_activity = true;
                break;
            }
        }
        if($activity->type->signup == 1) {
            $activity->players()->sync([
                $player_id => ['confirmed_at' => Carbon::now(), 'signed_up_at' => Carbon::now(), 'declined_at' => NULL]
            ],false);
            $code = 201;
        } elseif($my_activity == true && $activity->type->decline == 1) {
            $activity->players()->sync([
                $player_id => ['confirmed_at' => Carbon::now(), 'signed_up_at' => NULL, 'declined_at' => NULL]
            ], false);
            $code = 200;
        }

        if($code) {
            $activity->save();
            try {
                $decline = WeDecline::where('training_id', $request->activity_id)->firstOrFail();
                $decline->delete();
                $code = 204;
            } catch (ModelNotFoundException $e) {
                $code = 200;
            }
            return response()->json("success", $code);
        }
        $code = 400;
        return response()->json("Bad request", $code);
            //Logging::insert("confirmTraining",$input);
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
        $my_activity = false;
            try {

                $activity = WeActivity::findOrFail($request->activity_id);
                $activity->load("players","type");
                foreach ($activity->players as $p) {
                    if ($p->id === $player_id) {
                        $my_activity = true;
                    }
                }

            } catch (ModelNotFoundException $e) {
                $activity = false;
                return response()->json(array("error" => "Activity not found!"), 404);
            }
            if ($my_activity || ($activity->type && $activity->type->signup == 1)) {
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
                    $player_id => ['declined_at' => Carbon::now(), 'confirmed_at' => NULL, 'signed_up_at' => NULL]
                ],false);
                $activity->save();
                //Logging::insert("declineTraining",$input);
                return response()->json($request, $statusCode);

            }


        return response()->json(array("error" => "Bad request!"), 400, array("header" => "Bad Request"));

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
    public function show($id, Request $request)
    {
        $user = $request->get('user');
        $user->load("roles");
        if($id) {
            try {
                $activity = WeActivity::findOrFail($id);
                $act = new CalendarHelper();
                $activity = $act->setProps($activity,$user);
                return response()->json(["data" => $activity],200);
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

    public function types(Request $request) {
        return response()->json(["data" => WeActivityType::all()],200);
    }
}
