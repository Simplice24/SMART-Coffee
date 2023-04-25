<?php

namespace App\Http\Controllers;
use App\Models\Reporter;
use App\Models\Farmer;
use App\Models\User;

use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function ReportPrevilegePage($id){
        $farmer=$id;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('Manager/Previlege',['farmer'=>$farmer,'profileImg'=>$profileImg]);
    }
}
