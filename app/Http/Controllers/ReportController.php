<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Stock;
use App\Models\Sales;
use App\Models\User;

class ReportController extends Controller
{
    public function DurationForm(){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      return view('Manager/DurationForm',['profileImg'=>$profileImg]);
    }
}
