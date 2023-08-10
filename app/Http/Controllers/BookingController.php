<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\BookingCreateRequest;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Booking::with(['user.supervisor', 'vehicle', 'driver', 'approvedBy']);
            if ($request->user()->role == 'supervisor') {
                $query->whereHas('user', function ($query) {
                    $query->where('supervisor_id', auth()->user()->id);
                });
            } elseif ($request->user()->role == 'employee') {
                $query->where('user_id', auth()->user()->id);
            }
            if ($request->filled('period')) {
                $period = $request->input('period');
                switch ($period) {
                    case 'today':
                        $query->whereDate('created_at', now());
                        break;
                    case 'one_week':
                        $query->whereDate('created_at', '>=', now()->subWeek());
                        break;
                    case 'one_month':
                        $query->whereDate('created_at', '>=', now()->subMonth());
                        break;
                    case 'three_month':
                        $query->whereDate('created_at', '>=', now()->subMonths(3));
                        break;
                    case 'six_month':
                        $query->whereDate('created_at', '>=', now()->subMonths(6));
                        break;
                    case 'one_year':
                        $query->whereDate('created_at', '>=', now()->subYear());
                        break;
                    default:
                        // Tidak melakukan filter tambahan jika memilih "All" atau pilihan lainnya
                        break;
                }
            }
            $bookings = $query->get();
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

    public function approve(Booking $booking)
    {
        $role = auth()->user()->role;
        if ($role == 'employee') {
            if ($booking->user_id != auth()->user()->id) {
                return redirect()->route('booking.index')->with('alert', [
                    'status' => 'error',
                    'message' => 'You are not authorized to approve this booking.'
                ]);
            }
            $booking->update([
                'status' => '0',
                'approval_by' => auth()->user()->id,
                'approval_level' => '1'
            ]);
        } elseif ($role == 'supervisor') {
            if ($booking->user->supervisor_id != auth()->user()->id) {
                return redirect()->route('booking.index')->with('alert', [
                    'status' => 'error',
                    'message' => 'You are not authorized to approve this booking.'
                ]);
            }
            $booking->update([
                'status' => '1',
                'approval_by' => auth()->user()->id,
                'approval_level' => '2'
            ]);
        }
        return redirect()->route('booking.index')->with('alert', [
            'status' => 'success',
            'message' => 'Booking approved successfully.'
        ]);
    }

    //reject booking
    public function reject(Booking $booking)
    {
        $role = auth()->user()->role;
        if ($role == 'employee') {
            if ($booking->user_id != auth()->user()->id) {
                return redirect()->route('booking.index')->with('alert', [
                    'status' => 'error',
                    'message' => 'You are not authorized to reject this booking.'
                ]);
            }
            $booking->update([
                'status' => '2',
                'approval_by' => auth()->user()->id,
                'approval_level' => '3'
            ]);
        } elseif ($role == 'supervisor') {
            if ($booking->user->supervisor_id != auth()->user()->id) {
                return redirect()->route('booking.index')->with('alert', [
                    'status' => 'error',
                    'message' => 'You are not authorized to reject this booking.'
                ]);
            }
            $booking->update([
                'status' => '2',
                'approval_by' => auth()->user()->id,
                'approval_level' => '4'
            ]);
        }
        return redirect()->route('booking.index')->with('alert', [
            'status' => 'success',
            'message' => 'Booking rejected.'
        ]);
    }
}
