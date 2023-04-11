<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;
use App\Models\Cell;

class DropdownController extends Controller
{
    public function getDistricts(Request $request)
    {
        $districts=District::where('provincecode',$request->provincecode)->get();
        return response()->json($districts);
    }

    public function getSectors(Request $request){
        $sectors=Sector::where('districtcode',$request->districtcode)->get();
        return response()->json($sectors);
    }

    public function getCells(Request $request){
        $cells=Cell::where('sectorcode',$request->sectorcode)->get();
        return response()->json($cells);
    }
}
