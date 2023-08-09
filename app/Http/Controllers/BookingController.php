<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingCreateRequest;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bookings = Booking::with(['user.supervisor', 'vehicle', 'driver', 'approvedBy'])->get();
            return datatables()->of($bookings)
                ->addIndexColumn()
                ->make(true);
        }
        $head = [
            '#',
            'Name',
            'Pickup Location',
            'Destination',
            'Pickup Date',
            'Approved By',
            'Approved Level',
            'Status',
        ];
        return view('booking.index', compact('head'));
    }

    //create booking
    public function create()
    {
        return view('booking.create');
    }

    //store booking
    public function store(BookingCreateRequest $request)
    {
        // dd($request->all());
        $validated = $request->validated();
        $validated['status'] = '0';
        Booking::create($validated);
        return redirect()->route('booking.index')->with('alert', [
            'status' => 'success',
            'message' => 'Booking created successfully.'
        ]);
    }
}
