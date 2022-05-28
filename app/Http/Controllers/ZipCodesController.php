<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZipCodesRequest;
use Illuminate\Http\Request;

class ZipCodesController extends Controller
{
    public function show($zipCode)
    {
        return response()->json([
            'zipCode' => $zipCode
        ], 200);
    }
}
