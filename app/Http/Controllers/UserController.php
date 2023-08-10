<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('role', '!=', 'admin')
                ->get();
            return datatables()->of($users)
                ->addIndexColumn()
                ->make(true);
        }
        $head = [
            '#',
            'Name',
            'Phone Number',
            'Role',
        ];
        return view('users.index', compact('head'));
    }

    public function autocomplete(Request $request): JsonResponse
    {
        $data = [];
        if ($request->filled('q')) {
            $data = User::where('name', 'like', '%' . $request->input('q') . '%')
                ->where('role', '!=', 'admin')
                ->Where('role', '!=', 'supervisor')
                ->get();
        }
        return response()->json($data);
    }
}
