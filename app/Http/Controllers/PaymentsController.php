<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Support\Facades\DB;
use stdClass;

class PaymentsController extends Controller
{
    public function index() {

        return view('admin.payments');
    }

    public function getPaymentRecords($isIndependent) {

        // Filters if requested data is by
        // individual, corporate clients or both.
        switch ($isIndependent) {
            case "true":
                $clientRange = [1];
                break;
            case "false":
                $clientRange = [0];
                break;
            default:
                $clientRange = [0,1];
        }

        $reservations = Reservation::with(
                ['form' => function($q1) {
                    $q1->whereHas('post', function($q2) {
                        $q2->where('user_id', auth()->id());
                    });
                }]
            )
            ->whereYear('actual_paydate', '>' , 2000)
            ->where('payment_cost', '>', 0)
            ->whereIn('is_independent', $clientRange)
            // ->join('forms as f', 'f.id', '=', 'reservations.form_id')
            ->select(
                'reservations.id',
                'payment_cost',
                'discounted_cost',
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
                        // Push new month and year and adds new entry.
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
                // Adds new entry of payment record
                $record = new stdClass();
                $record->month = $item->month;
                $record->year = $item->year;
                $record->total = $final_pay;
                array_push($uniquePayments, $record);
            }
        }

        // if ($typeId == 2) {
        //     // Adds new record properties with the count
        //     // of spaces used based on month and year.
        //     foreach($uniquePayments as $key=>$value) {
        //         $monthYear = $value->month.''.$value->year;
        //         foreach($reservations as $reservation) {
        //             if ($reservation->month.''.$reservation->year == $monthYear) {
        //                 $spaceKey = 'space'.$reservation->space_id;
        //                 if (property_exists($uniquePayments[$key], $spaceKey)) {
        //                     $uniquePayments[$key]->$spaceKey++;
        //                 } else {
        //                     $uniquePayments[$key]->$spaceKey = 1;
        //                 }
        //             }
        //         }
        //     }
        // }

        return response()->json($uniquePayments);
    }
}
