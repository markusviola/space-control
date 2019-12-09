<?php

namespace App\Http\Controllers;

use App\Form;
use App\Reservation;
use App\Status;
use App\Schedule;

class ReservationsController extends Controller
{
    public function index() {

        $isReserveList = true;
        $statuses = Status::all();

        $approvedForms = Form::with([
                'post',
                'schedules',
                'reservation',
                'reservation.status',
            ])
            ->where('is_approved', 1)
            ->latest()
            ->get();

        return view('admin.spacecontrol',
            compact(
                'isReserveList',
                'statuses',
                'approvedForms'
            )
        );
    }

    public function update($id) {

        $startDates = array();
        $endDates = array();
        $chosenDates = json_decode(request()->date_times, true);

        // Parses dates to PHP and stores it to arrays
        foreach($chosenDates as $date) {
            $startEpoch = strtotime($date['startDateTime']);
            $endEpoch = strtotime($date['endDateTime']);
            array_push($startDates, $this->phpDateConverter($startEpoch));
            array_push($endDates, $this->phpDateConverter($endEpoch));
        }

        // Converting dates to epoch
        $visitDate = strtotime(request()->visit_date);
        $payDate = strtotime(request()->paydate);
        $actualPayDate = strtotime(request()->actual_paydate);

        // Reservation field updates
        $reservation = Reservation::where('id', $id)->first();

        $reservation->status_id = request()->status_id;
        $reservation->is_independent = request()->is_independent;
        $reservation->corporate_name = request()->corporate_name;
        $reservation->visit_place = request()->visit_place;
        $reservation->will_noise = request()->will_noise;
        $reservation->remarks = request()->remarks;
        $reservation->actual_hours = request()->actual_hours;
        $reservation->payment_cost = request()->payment_cost;
        $reservation->discounted_cost = request()->discounted_cost;
        $reservation->invoice = request()->invoice;

        if (request()->status_id == 4) {
            $reservation->cancel_reason = request()->cancel_reason;
        } else $reservation->cancel_reason = null;

        // Updates date related fields
        $reservation->paydate = $this->phpDateConverter($payDate);
        $reservation->actual_paydate = $this->phpDateConverter($actualPayDate);
        $reservation->visit_date = $this->phpDateConverter($visitDate);
        $reservation->save();

        $form = Form::where('id', $reservation->form->id)->first();
        $formId = $form->id;

        $form->email = request()->email;
        $form->phone = request()->phone;
        $form->user_count = request()->user_count ?? 1;
        $form->save();

        // Updating reservation schedules
        Schedule::where('form_id', $formId)->delete();
        for ($i = 0; $i < sizeof($startDates); $i++) {
            Schedule::create([
                'form_id' => $formId,
                'start_time' => $startDates[$i],
                'end_time' => $endDates[$i],
            ]);
        }

        return;
    }

    public function phpDateConverter($time) {
        return date(
            'Y-m-d H:i:s',
            $time
        );
    }
}
