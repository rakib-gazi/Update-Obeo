<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Hotel;
use App\Models\PaymentMethod;
use App\Models\Rate;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReservationController extends Controller
{
    //Reservation form
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
    //add reservation
    function addreservation(Request $request)
    {
        $messages = [
        'reservation_no.regex' => 'Reservation number must be a number.',
            'hotel_id.required' =>'The hotel is required',
            'rate_id.required' =>'The Exchange Rate is required',
            'source_id.required' =>'The Reservation Source is required',
            'payment_method_id.required' =>'The Payment Method is required',
            'currency_id.required_with' => 'Advance currency is required',
            'phone.required_without' => 'Phone or email is required.',
            'email.required_without' => 'Phone or email is required.',
            'total_adult.integer' => 'Total adults must be a number.',

            'rooms.*.name.required' => 'Room name is required.',
            'rooms.*.total_night.required' => 'Night required.',
            'rooms.*.total_night.integer' => 'Must be number.',
            'rooms.*.total_night.min' => 'Minimum 1 night.',
            'rooms.*.total_night.max' => 'Maximum 99 night.',
            'rooms.*.total_room.required' => 'Rooms required.',
            'rooms.*.total_room.integer' => 'Must be number',
            'rooms.*.total_room.min' => 'Minimum 1 Room.',
            'rooms.*.total_room.max' => 'Maximum 50 Room.',
            'rooms.*.total_price.required' => 'Price required.',
            'rooms.*.total_price.numeric' => 'Must be number',
            'rooms.*.total_price.max' => 'Maximum 0 .',
            'rooms.*.currency_id.required' => 'Currency required.',
        ];
        $data = $request->validate([
//            obeo sl
            'status_id' => 'nullable|exists:reservation_statuses,id',
            'reservation_no' => 'required|regex:/^\d+$/|unique:reservations,reservation_no',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'reservation_date' => 'required|date',
            'hotel_id' => 'required|exists:hotels,id',
            'guest_name' => 'required|string|max:255',
            'rate_id' => 'required|exists:rates,id',
            'total_advance' => 'nullable|numeric|min:0',
            'currency_id' => 'nullable|required_with:total_advance|exists:currencies,id',
            'source_id' => 'required|exists:sources,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'phone' => 'required_without:email|nullable|string|max:17|min:11',
            'email' => 'required_without:phone|nullable|email',
            'total_adult' => 'required|integer|min:1',
            'request' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',

            'children' => 'nullable|array',
            'children.*.age' => 'required|integer|min:0|max:17',

            'rooms' => 'required|array|min:1',
            'rooms.*.name' => 'required|string|max:255',
            'rooms.*.total_night' => 'required|integer|min:1|max:99',
            'rooms.*.total_room' => 'required|integer|min:1||max:99',
            'rooms.*.total_price' => 'required|numeric|min:0',
            'rooms.*.currency_id' => 'required|exists:currencies,id',
        ],$messages);
        return response()->json(['message'=>'ok']);
    }
}
