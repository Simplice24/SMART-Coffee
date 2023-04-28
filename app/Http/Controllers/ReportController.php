<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Stock;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function DurationForm(){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      return view('Manager/DurationForm',['profileImg'=>$profileImg]);
    }

    public function ReportGeneration(Request $req){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);  
      $start=$req->starting_date;
      $end=$req->ending_date;
      $format=$req->format;
      if($format==="PDF"){
        $stocks = DB::table('stocks')
            ->whereBetween('created_at', [$start, $end])
            ->get();
            return view('Manager/Report-data',['stocks'=>$stocks,'profileImg'=>$profileImg]);
      }  
    }
}
