<?php

namespace App\Http\Controllers;

use App\Reservation;
use App\Space;
use Illuminate\Support\Facades\DB;
use stdClass;

class PaymentsController extends Controller
{
    public function getPaymentRecords($typeId) {

        $reservations = Reservation::whereHas('form',
            function($q) use($typeId) {
                $q->where('type_id', $typeId);
            })
            ->whereYear('actual_paydate', '>' , 2000)
            ->where('payment_cost', '>', 0)
            ->join('forms as f', 'f.id', '=', 'reservations.form_id')
            ->join('bulk_spaces', 'bulk_spaces.form_id','f.id')
            ->select(
                'is_independent',
                'reservations.id',
                'payment_cost',
                'discounted_cost',
                'space_id',
                DB::raw('month(actual_paydate) month'),
                DB::raw('year(actual_paydate) year')
            )
            ->get();

        $uniqueIds = array();
        $uniqueMonthYears = array();
        $uniqueReservations = array();
        $uniquePayments = array();
        // Filters array with unique reservation IDs only.
        foreach($reservations as $item) {
            if(!in_array($item->id, $uniqueIds)) {
                array_push($uniqueIds, $item->id);
                array_push($uniqueReservations, $item);
            }
        }

        foreach($uniqueReservations as $item) {
            $monthYear = $item->month.''.$item->year;

            // Gets payment of item, prioritized discounted cost.
            $final_pay = $item->discounted_cost > 0 ? $item->discounted_cost : $item->payment_cost;

            if (sizeof($uniquePayments)) {
                foreach($uniquePayments as $key=>$value) {
                    if ($value->month.''.$value->year == $monthYear) {
                        // Combines payment with the same month and year.
                        $uniquePayments[$key]->total+= $final_pay;
                    } else {
                        // Adds new month and year with payment
                        if (!in_array($monthYear, $uniqueMonthYears)) {
                            array_push($uniqueMonthYears, $monthYear);
                            $record = new stdClass();
                            $record->month = $item->month;
                            $record->year = $item->year;
                            $record->total = $final_pay;
                            array_push($uniquePayments, $record);
                        }
                    }
                }
            } else {
                $record = new stdClass();
                $record->month = $item->month;
                $record->year = $item->year;
                $record->total = $final_pay;
                array_push($uniquePayments, $record);
            }
        }

        foreach($uniquePayments as $key=>$value) {
            $monthYear = $value->month.''.$value->year;
            foreach($reservations as $reservation) {
                if ($reservation->month.''.$reservation->year == $monthYear) {
                    $spaceKey = 'space'.$reservation->space_id;
                    if (property_exists($uniquePayments[$key], $spaceKey)) {
                        $uniquePayments[$key]->$spaceKey++;
                    } else {
                        $uniquePayments[$key]->$spaceKey = 1;
                    }
                }
            }
        }

        return $uniquePayments;
    }
}
