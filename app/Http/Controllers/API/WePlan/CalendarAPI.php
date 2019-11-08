<?php

namespace App\Http\Controllers\API\WePlan;

use App\Helpers\CalendarHelper;
use App\Models\WePlan\WeActivity;
use App\Models\WePlan\WeActivityType;
use App\Models\WePlan\WeDecline;
use App\Models\WePlan\WePlayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;

class CalendarAPI extends Controller
{
    private $date;
    /**
     * Display a listing of the resource.
     * @param Date
     * @return \Illuminate\Http\Response
     */
    public function plan($date)
    {
        $this->date = $date;
        $players = WePlayer::orderByRaw('ISNULL(team_id), team_id ASC')->orderBy("gender","asc")->orderBy("name","asc")->get();
        $players->load("team","user");
        $players->load(["declines" => function ($q) {
            $q->where("start_date", "<=", $this->date);
            $q->where("end_date", ">=", $this->date);
            $q->orWhere("start_date", $this->date);
            $q->where("end_date", NULL);
            $q->orderBy("start_date","asc");
        }, "activities" => function ($q) {
            $q->where("start_date", "<=", $this->date);
            $q->where("end_date", ">=", $this->date);
            $q->orWhere("start_date", $this->date);
            $q->where("end_date", NULL);
            $q->orderBy("start_date","asc");
        }]);
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
     * Display a listing of the resource.
     * @param string
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function get($type = null, $date = null, $filter = null, Request $request)
    {
        if($type &&  ($type == "day" || $type == "week" || $type == "month") || $type == "year") {

            $filter = false;
            $my_filter = false;
            if ($request->filters) {
                foreach ($request->filters as $key => $value) {
                    if ($value == "true") {
                        if ($key == 0) {
                            $my_filter = true;
                        } else {
                            $filter[] = $key;
                        }
                    }
                }
            }

            $user = $request->get('user');
            $user->load("roles");

            if ($date == null) { // if no date is given, set current date as start
                $date = date("Y-m-d");
            }

            $cal = new CalendarHelper($date, $type);


            if ($user->WePlayer) {
                $player_id = $user->WePlayer->id;
                $user->WePlayer->declines = WeDecline::where("start_date", ">=", $cal->start)->where("start_date", "<=", $cal->end)->orderBy("start_date", "ASC")->get();
            } else {
                $player_id = false;
            }
            try {
                $filterArray = null;
                $relations = ["players","type","players.user","responsible.UserInfo"];
                if ($filter) {
                    $activities = WeActivity::with($relations)->whereIn("type_id", $filter)->where("start_date", ">=", $cal->start)->where("start_date", "<=", $cal->end)->orderBy("start_date", "ASC")->orderBy("start", "ASC")->get();
                } else {
                    $activities = WeActivity::with($relations)->where("start_date", ">=", $cal->start)->where("start_date", "<=", $cal->end)->orderBy("start_date", "ASC")->orderBy("start", "ASC")->get();
                }
                //$activities->load(["type", "players", "players.user", "responsible", "responsible.UserInfo"]);
                if(!$activities) {
                    return response()->json("No activities", 404);
                }
                foreach ($activities as $activity) {
                    $activity = $cal->setProps($activity,$user);
                    if ($my_filter && $activity->my_activity) {
                    $filterArray[] = $activity;
                    }
                }
            } catch (ModelNotFoundException $e) {
                return response()->json("No activities found", 404);
            }
            if ($my_filter) {
                $activities = $filterArray;
            }
            $data = $activities;
            $ld = "";
            $cal->days = array();
            $i = 0;
            $act = array();
            if($activities) {
                foreach ($activities as $activity) {
                    if ($activity->start_date == $ld) {
                        array_push($act, $activity);
                        $cal->days[$i] = array("date" => $activity->start_date, "activities" => $act);

                    } else {
                        $i++;
                        if (!$ld) {
                            $i = 0;
                        }
                        $ld = $activity->start_date;
                        $act = array();
                        array_push($act, $activity);
                        $cal->days[$i] = array("date" => $activity->start_date, "activities" => $act);

                    }
                }
            }
            $types = WeActivityType::all();


            $this_week_url = route("api.v1.activities.get", ["date" => $cal->this_week]);
            $next_week_url = route("api.v1.activities.get", ["date" => $cal->next_week]);
            $prev_week_url = route("api.v1.activities.get", ["date" => $cal->prev_week]);


            return response()->json(array("calendar" => $cal, "user" => $user, "types" => $types, "data" => $data, "this_week_url" => $this_week_url, "next_week_url" => $next_week_url, "prev_week_url" => $prev_week_url, "start_date" => $cal->start, "end_date" => $cal->end, "next_week" => $cal->next_week, "prev_week" => $cal->prev_week));
            //$activities = WeActivity::paginate(4);
            //$activities->load("");


            return $activities;
        } else {
            return response()->json("Bad request",400);
        }
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
