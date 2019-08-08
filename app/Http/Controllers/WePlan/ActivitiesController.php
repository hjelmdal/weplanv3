<?php

namespace App\Http\Controllers\WePlan;

use App\Helpers\UUID;
use App\Http\Controllers\API\WePlan\WeActivitiesAPI;
use App\Models\WePlan\WeActivity;
use App\Models\WePlan\WeActivityType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date = null)
    {
        //$activities = new WeActivitiesAPI();
        //$activities = $activities->index();
        return view("app.activities.index",["date" => $date]);
    }

    public function admin($date = null) {
        return view("app.activities.admin",["date" => $date]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = WeActivityType::all();
        return view("app.activities.create",["activity" => null,"types" => $types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'info' => 'required',
        ]);

        if($id) {
            try {
                $activity = WeActivity::findOrFail($id);
            } catch (ModelNotFoundException $e) {
                return response()->json("Aktiviteten blev ikke fundet", 404);
            }
        } else {
            $activity = new WeActivity();
        }
        $activity->title = $request->title;
        $activity->info = $request->info;
        $activity->type_id = $request->type_id;
        $activity->address = $request->address;
        $activity->start_date = $request->start_date;
        $activity->start = $request->start;
        $activity->end_date = $request->end_date;
        $activity->end = $request->end;
        $activity->response_date = $request->response_date;
        $activity->response_time = $request->response_time;
        if($request->recur && $request->recur_end) {
            $activity->recurring_id = UUID::v4();
        }

        if($request->recur && $request->recur_end) {
            $first = strtotime($activity->start_date);
            $last = strtotime($request->recur_end);
            $datediff = $last - $first;

            $num = round($datediff / (60 * 60 * 24 * 7));

            $i = 0;
            $start_date = (string) $request->input("start_date");
            $end_date = (string) $request->input("end_date");
            $response_date = (string) $request->input("response_date");
            while ($i++ < $num) {
                // Create a new DateTime object
                $start_date = new \DateTime($start_date);
                $end_date = new \DateTime($end_date);
                $response_date = new \DateTime($response_date);
                // Modify the date it contains
                $start_date->modify('+7 days');
                $end_date->modify('+7 days');
                $response_date->modify('+7 days');
                $start_date = $start_date->format("Y-m-d");
                $end_date = $end_date->format("Y-m-d");
                $response_date = $response_date->format("Y-m-d");

                $act = new WeActivity();
                $act->title = $request->title;
                $act->info = $request->info;
                $act->type_id = $request->type_id;
                $activity->address = $request->address;
                $act->start_date = $start_date;
                $act->start = $request->start;
                $act->end_date = $end_date;
                $act->end = $request->end;
                $act->response_date = $response_date;
                $act->response_time = $request->response_time;
                $act->recurring_id = $activity->recurring_id;
                $act->save();

            }



        }

        $activity->save();

        //return redirect()->route("coach.activities.create")->with("message", "Aktiviteten er oprettet korrekt!")->with("title","Succes!");
        return response()->json("YAY",201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = new WeActivitiesAPI();
        $activity = $activity->show($id);
        return view("app.activities.show",["activity" => $activity]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = WeActivityType::all();
        try {
            $activity = WeActivity::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return "Model not found";
        }
        return view("app.activities.create",["activity" => $activity,"types" => $types]);
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
        return $this->store($request,$id);

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

    public function plan($date = null) {
        return view("app.activities.plan",["date" => $date]);
    }
}
