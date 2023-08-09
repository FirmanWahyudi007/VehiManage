<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $vehicles = Vehicle::all();
            return datatables()->of($vehicles)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        $head = [
            '#',
            'Merk',
            'Type',
            'Year',
            'License Plate',
        ];
        return view('vehicles.index', compact('head'));
    }

    //autocomplete
    public function autocomplete(Request $request): JsonResponse
    {
        $data = [];
        if ($request->filled('q')) {
            $data = Vehicle::search($request->input('q'))->get();
        }
        return response()->json($data);
    }
}
