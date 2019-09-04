<?php

namespace App\Http\Controllers;

use App\Discovery;
use App\Form;
use App\Reservation;
use App\Status;
use App\Type;
use App\BulkSpace;
use App\Schedule;
use App\Space;

class ReservationsController extends Controller
{
    public function index() {

        $isReserveList = true;
        $typeId = (int) request()->query('type');
        $types = Type::all();
        $spaces = Space::all();
        $discoveries = Discovery::all();
        $statuses = Status::all();

        $approvedForms = Form::with([
                'type',
                'schedules',
                'bulkSpaces',
                'reservation',
                'reservation.status',
                'reservation.discovery',
            ])
            ->where('type_id', $typeId)
            ->where('is_approved', 1)
            ->latest()
            ->get();

        return view('home',
            compact(
                'isReserveList',
                'types',
                'spaces',
                'discoveries',
                'statuses',
                'typeId',
                'approvedForms'
            )
        );
    }

    public function update($id) {

        $startDates = array();
        $endDates = array();
        $chosenDates = json_decode(request()->date_times, true);
        $chosenSpaces = json_decode(request()->check_spaces, true);
        $typeId = request()->type_id;

        // Parses dates to PHP and stores it to arrays
        foreach($chosenDates as $date) {
            $startEpoch = strtotime($date['startDateTime']);
            $endEpoch = strtotime($date['endDateTime']);
            array_push($startDates, $this->phpDateConverter($startEpoch));
            array_push($endDates, $this->phpDateConverter($endEpoch));
        }

        // Converting dates to epoch
        $visitDate = strtotime(request()->visit_date.' +1 day');
        $payDate = strtotime(request()->paydate.' +1 day');
        $actualPayDate = strtotime(request()->actual_paydate.' +1 day');

        // Reservation field updates
        $reservation = Reservation::where('id', $id)->first();

        $reservation->status_id = request()->status_id;
        $reservation->discovery_id = request()->discovery_id;
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

        $form->will_stay = request()->will_stay;
        $form->email = request()->email;
        $form->phone = request()->phone;
        $form->user_count = request()->user_count ?? 1;

        $form->save();

        // For room rentals, updates room reservations
        if ($typeId == 2) {
            BulkSpace::where('form_id', $formId)->delete();
            foreach($chosenSpaces as $space) {
                if ($space['is_selected']) {
                    BulkSpace::create([
                        'space_id' => $space['id'],
                        'form_id' => $formId
                    ]);
                }
            }
        }

        // Updating reservation schedules
        Schedule::where('form_id', $formId)->delete();
        for ($i = 0; $i < sizeof($startDates); $i++) {
            Schedule::create([
                'form_id' => $formId,
                'start_time' => $startDates[$i],
                'end_time' => $endDates[$i],
            ]);
            if (request()->will_stay) break;
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
