<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthUserRoomsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type) {
            $type = $request->type;
            $params = $request->params;
            return $this->$type($params);
        }
        return Inertia::render('Application/Index', [
            'rooms' => AuthUserRoomsResource::collection(Auth::user()->rooms)
        ]);
    }

    private function getUserRooms()
    {
        return response()->json([
            'data' => AuthUserRoomsResource::collection(Auth::user()->rooms)
        ]);
    }
}
