<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role == 'admin') {
            $usageData = Booking::join('vehicles', 'bookings.vehicle_id', '=', 'vehicles.id')
                ->selectRaw("MONTH(bookings.pickup_date) as month, vehicles.license_plate, vehicles.merk, COUNT(*) as total")
                ->where('bookings.status', 1)
                ->where('bookings.pickup_date', '<=', now()->format('Y-m-d'))
                ->groupBy('month', 'vehicles.license_plate', 'vehicles.merk')
                ->get();
            $vehicles = Vehicle::count();
            $drivers = Driver::count();
            $users = User::where('role', '!=', 'admin')->count();
            $bookings = Booking::count();
            $approved = Booking::where('status', 1)->count();
            $rejected = Booking::where('status', 2)->count();
            $pending = Booking::where('status', 0)->count();
            return view('dashboard', compact(
                'vehicles',
                'drivers',
                'users',
                'bookings',
                'approved',
                'rejected',
                'pending',
                'usageData'
            ));
        } else if ($request->user()->role == 'employee') {
            $bookings = Booking::where('user_id', $request->user()->id)->count();
            $approved = Booking::where('user_id', $request->user()->id)->where('status', 1)->count();
            $rejected = Booking::where('user_id', $request->user()->id)->where('status', 2)->count();
            $pending = Booking::where('user_id', $request->user()->id)->where('status', 0)->count();
            return view('dashboard', compact(
                'bookings',
                'approved',
                'rejected',
                'pending',
            ));
        } else if ($request->user()->role == 'supervisor') {
            $bookings = Booking::whereHas('user', function ($query) use ($request) {
                $query->where('supervisor_id', $request->user()->id);
            })->count();
            $approved = Booking::whereHas('user', function ($query) use ($request) {
                $query->where('supervisor_id', $request->user()->id);
            })->where('status', 1)->count();
            $rejected = Booking::whereHas('user', function ($query) use ($request) {
                $query->where('supervisor_id', $request->user()->id);
            })->where('status', 2)->count();
            $pending = Booking::whereHas('user', function ($query) use ($request) {
                $query->where('supervisor_id', $request->user()->id);
            })->where('status', 0)->count();
            return view('dashboard', compact(
                'bookings',
                'approved',
                'rejected',
                'pending'
            ));
        }
    }
}
