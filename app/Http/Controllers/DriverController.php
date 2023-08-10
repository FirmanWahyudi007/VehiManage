<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $drivers = Driver::all();
            return datatables()->of($drivers)
                ->addIndexColumn()
                ->make(true);
        }
        $head = [
            '#',
            'Name',
            'Phone Number',
            'Status',
        ];
        return view('drivers.index', compact('head'));
    }


    public function autocomplete(Request $request): JsonResponse
    {
        $data = [];
        if ($request->filled('q')) {
            $data = Driver::where('name', 'like', '%' . $request->input('q') . '%')
                ->where('status', '=', '1');
            //cek apakah driver sudah dipesan atau belum pada tanggal yang dipilih hari ini sampai 7 hari kedepan
            $data = $data->whereDoesntHave('bookings', function ($query) use ($request) {
                $query->whereBetween('pickup_date', [
                    now()->format('Y-m-d'),
                    now()->addDays(7)->format('Y-m-d'),
                ])->where('status', '!=', 2);
            })->get();
        }
        return response()->json($data);
    }
}
