<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function StockDetails(){
      $user_id=auth()->user()->id;
      $i=0;
      $profileImg=User::find($user_id);
      $cooperative_id = DB::table('cooperative_user')
                   ->where('user_id', $user_id)
                   ->value('cooperative_id');
      if($cooperative_id){
        $CooperativeStock=Stock::where('cooperative_id',$cooperative_id)->paginate(10);
        return view('Manager/Cooperative-stock',['i'=>$i,'profileImg'=>$profileImg,'CooperativeStock'=>$CooperativeStock]);
      }             
    }
}
