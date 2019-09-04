<?php

namespace App\Http\Controllers;

use App\Discovery;
use App\Form;
use App\Space;
use App\Status;
use App\Type;

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
        return request();
    }
}
