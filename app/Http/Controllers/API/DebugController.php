<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DebugController extends Controller
{
    public function bounceRequest(Request $request)
    {
		return $request;
    }
}
