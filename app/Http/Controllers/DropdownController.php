<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;

class DropdownController extends Controller
{
    public function getProvinces()
{
    $provinces = Province::all();
    return response()->json($provinces);
}

public function getDistricts($province_id)
{
    $districts = District::where('province_id', $province_id)->get();
    return response()->json($districts);
}

}
