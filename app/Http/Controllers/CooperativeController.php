<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CooperativeController extends Controller
{
    public function SystemCooperatives(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('All-cooperatives',['profileImg'=>$profileImg]);
    }

    public function CooperativeRegistrationPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('Register-cooperative',['profileImg'=>$profileImg]);
    }
}
