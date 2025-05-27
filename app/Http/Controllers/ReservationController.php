<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Currency;
use App\Models\Hotel;
use App\Models\PaymentMethod;
use App\Models\Rate;
use App\Models\Reservation;
use App\Models\ReservationChild;
use App\Models\ReservationRoom;
use App\Models\Room;
use App\Models\Source;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReservationController extends Controller
{
    //all reservation page
    function reservations(Request $request)
    {
        return Inertia::render('Reservations');
    }
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
        Log::info('Reservation Data:', $data);
        DB::beginTransaction();
        try{
            do {
                // Numeric-only: YYYYMMDD + 4-digit random number
                $prefix = now()->format('Ymd'); // e.g. 20250527
                $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT); // e.g. 0384
                $obeoSL = (int)($prefix . $random); // e.g. 202505270384
            } while (Reservation::where('obeo_sl', $obeoSL)->exists());

            $reservation = Reservation::create([
                'obeo_sl' => $obeoSL,
                'status_id' => $data['status_id'] ?? null,
                'reservation_no' => $data['reservation_no'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'reservation_date' => $data['reservation_date'],
                'hotel_id' => $data['hotel_id'],
                'guest_name' => $data['guest_name'],
                'rate_id' => $data['rate_id'],
                'total_advance' => $data['total_advance'],
                'currency_id' => $data['currency_id'] ?? null,
                'source_id' => $data['source_id'],
                'payment_method_id' => $data['payment_method_id'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'total_adult' => $data['total_adult'],
                'request' => $data['request'],
                'comment' => $data['comment'],
            ]);
            // Save rooms
            foreach ($data['rooms'] as $roomData) {
                $room = Room::create([
                    'name' => $roomData['name'],
                    'total_room' => $roomData['total_room'],
                    'total_night' => $roomData['total_night'],
                    'total_price' => $roomData['total_price'],
                    'currency_id' => $roomData['currency_id'],
                ]);

                ReservationRoom::create([
                    'room_id' => $room->id,
                    'reservation_id' => $reservation->id,
                ]);
            }

            // Save children (if any)
            if (!empty($data['children'])) {
                foreach ($data['children'] as $childData) {
                    $child = Child::create(['age' => $childData['age']]);

                    ReservationChild::create([
                        'child_id' => $child->id,
                        'reservation_id' => $reservation->id,
                    ]);
                }
            }
            DB::commit();
            return redirect()->back();
        }
        catch (Exception $exception){
            DB::rollBack();
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
    // all reservations
    function getAllReservations()
    {
        $reservations = Reservation::with([
            'hotel:id,hotelName',
            'rate:id,rate',
            'currency:id,currency',
            'source:id,source',
            'paymentMethod:id,payment',
            'children:id,age',


            'rooms' => function ($query) {
                $query->select('rooms.id', 'name', 'total_room', 'total_night', 'total_price', 'currency_id')
                    ->with('currency:id,currency');
            }
        ])->get()
            ->makeHidden([
                'hotel_id', 'rate_id', 'currency_id', 'source_id', 'payment_method_id'
            ])
            ->map(function ($reservation) {
                // Remove pivot from children
                $reservation->children->transform(function ($child) {
                    unset($child->pivot);
                    return $child;
                });

                // Optionally remove pivot from rooms too
                $reservation->rooms->transform(function ($room) {
                    unset($room->pivot);
                    return $room;
                });

                return $reservation;
            });

        return Inertia::render('AllReservations', [
            'reservations' => $reservations
        ]);
//        return response()->json($reservations);
    }



}
