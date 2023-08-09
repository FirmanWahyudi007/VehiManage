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
                ->where('status', '=', '1')
                ->get();
        }
        return response()->json($data);
    }
}
