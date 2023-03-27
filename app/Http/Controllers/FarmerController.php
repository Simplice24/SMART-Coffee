<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cooperative;

class FarmerController extends Controller
{
    public function SystemFarmers(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('All-farmers',['profileImg'=>$profileImg]);
    }

    public function FarmerRegistrationPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $cooperatives=Cooperative::all();
        return view('Register-farmer',['profileImg'=>$profileImg,'cooperatives'=>$cooperatives]);
    }
}
