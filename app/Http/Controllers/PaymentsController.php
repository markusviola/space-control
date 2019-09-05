<?php

namespace App\Http\Controllers;

use App\Reservation;

class PaymentsController extends Controller
{
    public function getPaymentRecords($typeId) {

        $reservations = Reservation::whereHas('form', function($q) use($typeId) {
            $q->where('type_id', $typeId);
        })->whereYear('actual_paydate', '>' , date('2000'))
            ->where('payment_cost', '!=', 0)
            ->get();

        return response()->json($reservations);
    }
}
