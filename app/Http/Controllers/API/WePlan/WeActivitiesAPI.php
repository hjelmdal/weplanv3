<?php

namespace App\Http\Controllers\API\WePlan;

use App\Models\WePlan\WeActivity;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

class WeActivitiesAPI extends Controller
{

    public function index() {
        //
    }

    /**
     * Display a listing of the resource.
     * @param string
     * @return \Illuminate\Http\Response
     */
    public function get($date = null)
    {
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
        } catch (ModelNotFoundException $e) {
            return response()->json("No activities found", 404);
        }
        $data = $activities;
        $this_week_url = route("api.v1.activities.get",["date" => date("Y-m-d",$weektime)]);
        $next_week_url = route("api.v1.activities.get",["date" => date("Y-m-d",$weektime+604800)]);
        $prev_week_url = route("api.v1.activities.get",["date" => date("Y-m-d",$weektime-604800)]);
        $start_date = $dateObj->format("Y-m-d");
        return response()->json(array("data" => $data, "total" => 100, "to" => 4, "from" => 0,"this_week_url" => $this_week_url, "next_week_url" => $next_week_url, "prev_week_url" => $prev_week_url, "start_date" => $start_date));
        //$activities = WeActivity::paginate(4);
        //$activities->load("");


        return $activities;
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
