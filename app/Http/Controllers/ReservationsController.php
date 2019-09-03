<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index() {
        $isReserveList = true;
        return view('home',
            compact('isReserveList'));
    }

    public function update($id) {
        dd(request());
    }
}
