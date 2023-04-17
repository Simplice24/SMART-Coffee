<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use App\Models\Disease;
use App\Models\Cooperative;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;
use App\Models\Cell;
use App\Models\Sales;
use App\Models\ReportedDisease;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use session;

class OfficialsController extends Controller
{
    public function OfficialsDashboard(){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      $users_location=User::select('province','district','sector','cell')
                      ->where('id',$user_id)
                      ->get();
      $user_role=User::where('id',$user_id)->value('role');
      if($user_role==="SEDO"){
        $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
             ->whereIn('district', $users_location->pluck('district'))
             ->whereIn('sector', $users_location->pluck('sector'))
             ->whereIn('cell', $users_location->pluck('cell'))
             ->get();
        $cooperativeIds = $Cooperatives->pluck('id');

        $managerIds = DB::table('cooperative_user')
            ->whereIn('cooperative_id', $cooperativeIds)
            ->pluck('user_id');
        
        $managers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->get();
            
        $numberOfManagers=DB::table('users')
            ->whereIn('id',$managerIds)
            ->count();   

        $diseases=Disease::count();

        $farmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->get();

        $trees= Farmer::whereIn('cooperative_id',$cooperativeIds)->sum('number_of_trees');

        $numberOfFarmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->count();

        $numberOfCooperatives=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->count();

        
        return view('Official/Dashboard',['numberOfCooperatives'=>$numberOfCooperatives,'numberOfFarmers'=>$numberOfFarmers,'trees'=>$trees,
        'diseases'=>$diseases,'profileImg'=>$profileImg,'numberOfManagers'=>$numberOfManagers]);
      }
    }
}
