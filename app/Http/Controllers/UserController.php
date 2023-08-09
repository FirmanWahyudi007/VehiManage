<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    //autocomplete
    public function autocomplete(Request $request): JsonResponse
    {
        $data = [];
        if ($request->filled('q')) {
            $data = User::where('name', 'like', '%' . $request->input('q') . '%')
                ->where('role', '!=', 'admin')
                ->get();
        }
        return response()->json($data);
    }
}
