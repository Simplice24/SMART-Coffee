<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DiseaseController extends Controller
{
    public function SystemDiseases(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('All-diseases',['profileImg'=>$profileImg]);
    }

    public function DiseaseRegistrationPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('Register-disease',['profileImg'=>$profileImg]);
    }
}
