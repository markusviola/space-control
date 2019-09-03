<?php

namespace App\Http\Controllers;

use App\Form;
use App\Reservation;
use App\Type;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index() {
        $isReserveList = true;
        $typeId = (int) request()->query('type');
        $types = Type::all();
        $approvedForms = Form::where('type_id', $typeId)
            ->latest()
            ->get();

        return view('home',
            compact('isReserveList', 'types', 'typeId', 'approvedForms'));
    }

    public function update($id) {
        dd(request());
    }
}
