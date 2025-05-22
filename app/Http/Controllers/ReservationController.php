<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Hotel;
use App\Models\PaymentMethod;
use App\Models\Rate;
use App\Models\Source;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReservationController extends Controller
{
    //AddReservation
    function reservation(Request $request)
    {
        $hotels =  Hotel::select('id', 'hotelName')->get();
        $rates = Rate::select('id', 'rate')->get();
        $currencies = Currency::select('id', 'currency')->get();
        $sources = Source::select('id','source')->get();
        $payments = PaymentMethod::select('id', 'payment')->get();
        return Inertia::render('AddReservation',[
            'hotels' => $hotels,
            'rates' => $rates,
            'currencies' => $currencies,
            'sources' => $sources,
            'payments' => $payments
        ]);
    }
}
