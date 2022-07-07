<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthUserRoomsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ApplicationController extends Controller
{
    public function index()
    {
        return Inertia::render('Application/Index', [
            'rooms' => AuthUserRoomsResource::collection(Auth::user()->rooms)
        ]);
    }
}
