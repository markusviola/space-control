<?php

namespace App\Http\Controllers;

use App\BulkSpace;
use Illuminate\Http\Request;
use App\Form;
use App\Reservation;
use App\Schedule;
use App\Space;
use App\User;

class FormsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function approveForm($id) {

        $form = Form::whereId($id)->first();
        $form->triggerIsApproved()->save();
        $form->load(['type', 'bulkSpaces']);
        if ($form) {
            Reservation::create([
                'form_id' => $id
            ]);
        }

        return $form;
    }

    public function getFormDates($id) {

        $schedules = Schedule::whereFormId($id)->get();

        return response()->json($schedules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $startDates = array();
        $endDates = array();
        $dates = json_decode(request()->dates, true);

        foreach($dates as $date) {
            $startEpoch = strtotime($date['startDateTime']);
            $endEpoch = strtotime($date['endDateTime']);
            array_push($startDates, $this->phpDateConverter($startEpoch));
            array_push($endDates, $this->phpDateConverter($endEpoch));
        }

        $form = new Form();

        if (request()->user_id) {
            $user = User::where('id', request()->user_id)->first();
            $form->user_id = $user->id;
            $form->name = $user->name;
            $form->furigana = $user->furigana;
            $form->gender = $user->gender;
            $form->birthday = $user->birthday;
            $form->address = $user->address;
            $form->email = $user->email;
            $form->phone = $user->phone;

        } else {
            $form->name = request()->name;
            $form->furigana = request()->furigana;
            $form->gender = request()->gender;
            $form->birthday = request()->birthday;
            $form->address = request()->address;
            $form->email = request()->email;
            $form->phone = request()->phone;
        }

        $form->will_stay = false;
        if (request()->will_stay) {
            $form->will_stay = true;
        }

        $form->reason = request()->reason;
        $form->user_count = request()->user_count ?? 1;
        $form->type_id = request()->type_id;
        $form->save();

        $formId = $form->id;

        if (request()->type_id == 2) {
            $spaces = Space::all();
            foreach($spaces as $space) {
                if ($request['space_'.$space->id]) {
                    BulkSpace::create([
                        'space_id' => $space->id,
                        'form_id' => $formId
                    ]);
                }
            }
        }

        for ($i = 0; $i < sizeof($startDates); $i++) {
            Schedule::create([
                'form_id' => $formId,
                'start_time' => $startDates[$i],
                'end_time' => $endDates[$i],
            ]);
            if (request()->will_stay) break;
        }

        return redirect()->route('home', '#created-form');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
    // 2019-08-15T07:00:00.000Z
    public function phpDateConverter($time) {
        return date(
            'Y-m-d H:i:s',
            $time
        );
    }
}
