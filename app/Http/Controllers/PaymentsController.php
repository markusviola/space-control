<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Support\Facades\DB;

class PaymentsController extends Controller
{
    public function getPaymentRecords($typeId) {

        // $reservations = DB::table('reservations')
        //     ->select('payment_cost')
        //     ->whereHas('form', function($q) use($typeId) {
        //         $q->where('type_id', $typeId);
        //     })->whereYear('actual_paydate', '>' , 2000)
        //     ->where('payment_cost', '>', 0)
        //     ->get();

        $reservations = Reservation::whereHas('form', function($q) use($typeId) {
            $q->where('type_id', $typeId);
        })->whereYear('actual_paydate', '>' , 2000)
            ->where('payment_cost', '>', 0)
            ->join('forms as f', 'f.id', '=', 'reservations.form_id')
            ->join('bulk_spaces', 'bulk_spaces.form_id','f.id')
            ->select(
                DB::raw('(distinct(reservations.id), payment_cost) as W'),
                DB::raw('year(actual_paydate) year, month(actual_paydate) month'),
                DB::raw('sum(payment_cost) as total')
            )
            ->groupBy('year','month')
            ->get();


        // $user_info = DB::table('usermetas')
        // ->select('browser', DB::raw('count(*) as total'))
        // ->groupBy('browser')
        // ->pluck('total','browser')->all();

        return response()->json($reservations);
    }
}
