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

    public function getManagers(){
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
         
        $managers = DB::table('users')
            ->whereIn('users.id', $managerIds)
            ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
            ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
            ->whereIn('cooperatives.id', $cooperativeIds)
            ->select('users.name as manager_name', 'cooperatives.name as cooperative_name')
            ->get();    
        
        
        $no=0;    

        return view('Official/Managers',['profileImg'=>$profileImg,'managers'=>$managers,'no'=>$no]);    
        }
        elseif($user_role==="Sector-agro"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
               ->whereIn('district', $users_location->pluck('district'))
               ->whereIn('sector', $users_location->pluck('sector'))
               ->get();
          $cooperativeIds = $Cooperatives->pluck('id');
  
          $managerIds = DB::table('cooperative_user')
              ->whereIn('cooperative_id', $cooperativeIds)
              ->pluck('user_id');
           
          $managers = DB::table('users')
              ->whereIn('users.id', $managerIds)
              ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
              ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
              ->whereIn('cooperatives.id', $cooperativeIds)
              ->select('users.name as manager_name', 'cooperatives.name as cooperative_name')
              ->get();    
          $no=0;    
  
          return view('Official/Managers',['profileImg'=>$profileImg,'managers'=>$managers,'no'=>$no]);    
          }
          elseif($user_role==="District-agro"){
            $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                 ->whereIn('district', $users_location->pluck('district'))
                 ->get();
            $cooperativeIds = $Cooperatives->pluck('id');
    
            $managerIds = DB::table('cooperative_user')
                ->whereIn('cooperative_id', $cooperativeIds)
                ->pluck('user_id');
             
            $managers = DB::table('users')
                ->whereIn('users.id', $managerIds)
                ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
                ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
                ->whereIn('cooperatives.id', $cooperativeIds)
                ->select('users.name as manager_name', 'cooperatives.name as cooperative_name')
                ->get();    
            $no=0;    
    
            return view('Official/Managers',['profileImg'=>$profileImg,'managers'=>$managers,'no'=>$no]);    
            }
            else{
              $Cooperatives=Cooperative::all();
              $cooperativeIds = $Cooperatives->pluck('id');
              $managerIds = DB::table('cooperative_user')
                ->whereIn('cooperative_id', $cooperativeIds)
                ->pluck('user_id');
                $managers = DB::table('users')
                ->whereIn('users.id', $managerIds)
                ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
                ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
                ->whereIn('cooperatives.id', $cooperativeIds)
                ->select('users.id as userId','users.name as manager_name', 'cooperatives.name as cooperative_name')
                ->get();    
              $no=0;    
    
              return view('Official/Managers',['profileImg'=>$profileImg,'managers'=>$managers,'no'=>$no]);   
            }
      }

      public function getCooperatives(){
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

          $cooperatives = DB::table('cooperatives')
                    ->whereIn('id', $cooperativeIds)
                    ->get();

          $no=0;    
  
          return view('Official/Cooperatives',['profileImg'=>$profileImg,'cooperatives'=>$cooperatives,'no'=>$no]);    
          }
          elseif($user_role==="Sector-agro"){
            $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                 ->whereIn('district', $users_location->pluck('district'))
                 ->whereIn('sector', $users_location->pluck('sector'))
                 ->get();
            $cooperativeIds = $Cooperatives->pluck('id');
  
            $cooperatives = DB::table('cooperatives')
                      ->whereIn('id', $cooperativeIds)
                      ->get();
  
            $no=0;    
    
            return view('Official/Cooperatives',['profileImg'=>$profileImg,'cooperatives'=>$cooperatives,'no'=>$no]);    
            }
            elseif($user_role==="District-agro"){
              $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                   ->whereIn('district', $users_location->pluck('district'))
                   ->whereIn('sector', $users_location->pluck('sector'))
                   ->get();
              $cooperativeIds = $Cooperatives->pluck('id');
    
              $cooperatives = DB::table('cooperatives')
                        ->whereIn('id', $cooperativeIds)
                        ->get();
    
              $no=0;    
      
              return view('Official/Cooperatives',['profileImg'=>$profileImg,'cooperatives'=>$cooperatives,'no'=>$no]);    
              }
              else{
                $cooperatives=Cooperative::all();
                $no=0;
                return view('Official/Cooperatives',['profileImg'=>$profileImg,'cooperatives'=>$cooperatives,'no'=>$no]);
              }
          
      }
      public function getFarmers(){
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
          $farmers=Farmer::whereIn('cooperative_id', $cooperativeIds)->get();
          $no=0;

          return view('Official/Farmers',['profileImg'=>$profileImg,'farmers'=>$farmers,'no'=>$no]);
        }
        elseif($user_role==="Sector-agro"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
               ->whereIn('district', $users_location->pluck('district'))
               ->whereIn('sector', $users_location->pluck('sector'))
               ->get();
          $cooperativeIds = $Cooperatives->pluck('id');
          $farmers=Farmer::whereIn('cooperative_id', $cooperativeIds)->get();
          $no=0;

          return view('Official/Farmers',['profileImg'=>$profileImg,'farmers'=>$farmers,'no'=>$no]);
        }
        elseif($user_role==="District-agro"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
               ->whereIn('district', $users_location->pluck('district'))
               ->get();
          $cooperativeIds = $Cooperatives->pluck('id');
          $farmers=Farmer::whereIn('cooperative_id', $cooperativeIds)->get();
          $no=0;

          return view('Official/Farmers',['profileImg'=>$profileImg,'farmers'=>$farmers,'no'=>$no]);
        }else{
          $farmers=Farmer::all();
          $no=0;
          return view('Official/Farmers',['profileImg'=>$profileImg,'farmers'=>$farmers,'no'=>$no]);
        }
      }

      public function getDiseases(){
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
          
          $diseases=Disease::all();  
          
          $currentMonth=date('m');
          $currentYear=date('Y');
          $monthlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('MONTH(reported_diseases.created_at) as month'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->whereRaw('MONTH(reported_diseases.created_at) = ?', [$currentMonth])
                ->groupBy('month', 'diseases.disease_name')
                ->get();
                
          $yearlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('YEAR(reported_diseases.created_at) as year'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->whereRaw('YEAR(reported_diseases.created_at) = ?', [$currentYear])
                ->groupBy('year', 'diseases.disease_name')
                ->get();      
          $no=0;

          return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
          'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts]);
        }
        elseif($user_role==="Sector-agro"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                        ->whereIn('district', $users_location->pluck('district'))
                        ->whereIn('sector', $users_location->pluck('sector'))
                        ->get();
          $cooperativeIds = $Cooperatives->pluck('id');
          
          $diseases=Disease::all();  
          
          $currentMonth=date('m');
          $currentYear=date('Y');
          $monthlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('MONTH(reported_diseases.created_at) as month'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->whereRaw('MONTH(reported_diseases.created_at) = ?', [$currentMonth])
                ->groupBy('month', 'diseases.disease_name')
                ->get();
                
          $yearlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('YEAR(reported_diseases.created_at) as year'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->whereRaw('YEAR(reported_diseases.created_at) = ?', [$currentYear])
                ->groupBy('year', 'diseases.disease_name')
                ->get();      
          $no=0;

          return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
          'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts]);
        }
        elseif($user_role==="District-agro"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                        ->whereIn('district', $users_location->pluck('district'))
                        ->whereIn('sector', $users_location->pluck('sector'))
                        ->whereIn('cell', $users_location->pluck('cell'))
                        ->get();
          $cooperativeIds = $Cooperatives->pluck('id');
          
          $diseases=Disease::all();  
          
          $currentMonth=date('m');
          $currentYear=date('Y');
          $monthlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('MONTH(reported_diseases.created_at) as month'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->whereRaw('MONTH(reported_diseases.created_at) = ?', [$currentMonth])
                ->groupBy('month', 'diseases.disease_name')
                ->get();
                
          $yearlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('YEAR(reported_diseases.created_at) as year'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->whereRaw('YEAR(reported_diseases.created_at) = ?', [$currentYear])
                ->groupBy('year', 'diseases.disease_name')
                ->get();      
          $no=0;

          return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
          'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts]);
        }
        else{
        $currentMonth = date('m');
        $currentYear = date('Y');
        $monthlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('MONTH(reported_diseases.created_at) as month'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereRaw('MONTH(reported_diseases.created_at) = ?', [$currentMonth])
                ->groupBy('month', 'diseases.disease_name')
                ->get();
        $yearlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('YEAR(reported_diseases.created_at) as year'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereRaw('YEAR(reported_diseases.created_at) = ?', [$currentYear])
                ->groupBy('year', 'diseases.disease_name')
                ->get(); 
        $no=0;     

        return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
        'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts]);        
        }
      }
       
      public function getAnalytics(){

      }
}
