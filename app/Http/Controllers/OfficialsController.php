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
use App\Models\ReportedByPrediction;
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
      $currentYear=date('Y');
      $previousYear=$currentYear-1;
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

        $farmerIds = DB::table('farmers') 
                    ->whereIn('cooperative_id',$cooperativeIds)
                    ->pluck('id');
                       
        
        $managers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->get();

        //Managers percentage 
        $CurrentYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$currentYear])
            ->count(); 

        $PreviousYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$previousYear])
            ->count(); 
        
        if(!$PreviousYearManagers==0){
          $ManagersPercentage=($CurrentYearManagers - $PreviousYearManagers) / $PreviousYearManagers *100;
        }else{
          $ManagersPercentage=100;
        }    
            
        $numberOfManagers=DB::table('users')
            ->whereIn('id',$managerIds)
            ->count();   

        $diseases=Disease::count();

        $farmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->get();

        //Farmers percentage calculation
        $CurrentYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                           ->whereRaw('YEAR(farmers.created_at)=?',[$currentYear])
                           ->count();
                           
        $PreviousYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                            ->whereRaw('YEAR(farmers.created_at)=?',[$previousYear])
                            ->count();
              
        if(!$PreviousYearFarmers==0){
          $FarmersPercentage=($CurrentYearFarmers - $PreviousYearFarmers)/ $PreviousYearFarmers * 100;
        }else{
          $FarmersPercentage=100;
        }                    
                            

        $numberOfFarmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->count();

        $numberOfCooperatives=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->count();
       //Current and previous year cooperatives
        $CurrentYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$currentYear])
        ->count();
        $PreviousYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$previousYear])
        ->count();
        //Percentage of Cooperative increase comparing current and previous year
        if(!$PreviousYearCoop==0){
          $coopPercentage=($CurrentYearCoop - $PreviousYearCoop) / $PreviousYearCoop * 100;
        }else{
          $coopPercentage=100;
        }

        $MaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleManagersCount=$MaleManagers->count();         
    
        $MaleManagersByYearMonth = $MaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleManagerMonthYear=[];
        $MaleManagercount=[]; 
        
        foreach ($MaleManagersByYearMonth as $yearMonth => $maleManagers) {
          $MaleManagerMonthYear[]=$yearMonth;
          $MaleManagercount[]= count($maleManagers);
        }

        $FemaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleManagersCount=$FemaleManagers->count();              
    
        $FemaleManagersByYearMonth = $FemaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleManagerMonthYear=[];
        $FemaleManagercount=[]; 
        
        foreach ($FemaleManagersByYearMonth as $yearMonth => $femaleManagers) {
          $FemaleManagerMonthYear[]=$yearMonth;
          $FemaleManagercount[]= count($femaleManagers);
        }

        $MaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleFarmersCount=$MaleFarmers->count();              
    
        $MaleFarmersByYearMonth = $MaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleFarmerMonthYear=[];
        $MaleFarmercount=[]; 
        
        foreach ($MaleFarmersByYearMonth as $yearMonth => $maleFarmers) {
          $MaleFarmerMonthYear[]=$yearMonth;
          $MaleFarmercount[]= count($maleFarmers);
        }

        $FemaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleFarmersCount=$FemaleFarmers->count();              
    
        $FemaleFarmersByYearMonth = $FemaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleFarmerMonthYear=[];
        $FemaleFarmercount=[]; 
        
        foreach ($FemaleFarmersByYearMonth as $yearMonth => $femaleFarmers) {
          $FemaleFarmerMonthYear[]=$yearMonth;
          $FemaleFarmercount[]= count($femaleFarmers);
        }

        $ActiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
                      ->where('status','Operating')
                      ->get();
        $ActiveCooperativesCount=$ActiveCooperatives->count();              
    
        $ActiveByYearMonth = $ActiveCooperatives->groupBy(function ($coop) {
                    return $coop->created_at->format('Y-m');
                    });
        
        $ActiveCoopMonthYear=[];
        $ActiveCoopcount=[]; 
        
        foreach ($ActiveByYearMonth as $yearMonth => $activecoop) {
          $ActiveCoopMonthYear[]=$yearMonth;
          $ActiveCoopcount[]= count($activecoop);
        }

        $InactiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
        ->where('status','Not operating')
        ->get();
        $InactiveCooperativesCount=$InactiveCooperatives->count();

        $InactiveByYearMonth = $InactiveCooperatives->groupBy(function ($coop) {
              return $coop->created_at->format('Y-m');
              });

        $InactiveCoopMonthYear=[];
        $InactiveCoopcount=[]; 

        foreach ($InactiveByYearMonth as $yearMonth => $inactivecoop) {
        $InactiveCoopMonthYear[]=$yearMonth;
        $InactiveCoopcount[]= count($inactivecoop);
        }

        $Totaldiseases = DB::table('diseases')
                    ->select('category', DB::raw('COUNT(*) as current_month_total'))
                    ->groupBy('category')
                    ->get();

        $TotalReportedDiseases= DB::table('reported_diseases')    
                               ->whereIn('cooperative_id',$cooperativeIds)
                               ->count();
                                     
        $percentByDiseaseCategory =DB::table('diseases')
                               ->select('diseases.id', 'diseases.disease_name as disease_name', DB::raw('ROUND(COUNT(reported_diseases.id) * 100 / SUM(COUNT(*)) OVER(), 0) AS percentage'))
                               ->join('reported_diseases', 'diseases.id', '=', 'reported_diseases.disease_id')
                               ->whereIn('reported_diseases.cooperative_id',$cooperativeIds)
                               ->groupBy('diseases.id','disease_name')
                               ->orderBy('percentage', 'desc')
                               ->get();
                               
        
        $DiseaseCategoryPercentage = DB::table('reported_diseases')
                              ->select('disease_category', DB::raw('ROUND(COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) AS percentage'))
                              ->whereIn('cooperative_id',$cooperativeIds)
                              ->groupBy('disease_category')
                              ->get();                     
                                                
                               
                      
        return view('Official/Dashboard',['numberOfCooperatives'=>$numberOfCooperatives,'numberOfFarmers'=>$numberOfFarmers,
        'diseases'=>$diseases,'profileImg'=>$profileImg,'numberOfManagers'=>$numberOfManagers,'coopPercentage'=>$coopPercentage,
        'ManagersPercentage'=>$ManagersPercentage,'FarmersPercentage'=>$FarmersPercentage,'MaleManagerMonthYear'=>$MaleManagerMonthYear,
        'MaleManagercount'=>$MaleManagercount,'FemaleManagerMonthYear'=>$FemaleManagerMonthYear,'FemaleManagercount'=>$FemaleManagercount,
        'MaleFarmerMonthYear'=>$MaleFarmerMonthYear,'MaleFarmercount'=>$MaleFarmercount,'FemaleFarmerMonthYear'=>$FemaleFarmerMonthYear,
        'FemaleFarmercount'=>$FemaleFarmercount,'ActiveCoopMonthYear'=>$ActiveCoopMonthYear,'ActiveCoopcount'=>$ActiveCoopcount,'percentByDiseaseCategory'=>$percentByDiseaseCategory,
        'InactiveCoopMonthYear'=>$InactiveCoopMonthYear,'InactiveCoopcount'=>$InactiveCoopcount,'Totaldiseases'=>$Totaldiseases,'TotalReportedDiseases'=>$TotalReportedDiseases,
        'DiseaseCategoryPercentage'=>$DiseaseCategoryPercentage,'MaleManagersCount'=>$MaleManagersCount,'FemaleManagersCount'=>$FemaleManagersCount,'MaleFarmersCount'=>$MaleFarmersCount,
        'FemaleFarmersCount'=>$FemaleFarmersCount,'ActiveCooperativesCount'=>$ActiveCooperativesCount,'InactiveCooperativesCount'=>$InactiveCooperativesCount]);
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

        $farmerIds = DB::table('farmers') 
                    ->whereIn('cooperative_id',$cooperativeIds)
                    ->pluck('id');
                       
        
        $managers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->get();

        //Managers percentage 
        $CurrentYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$currentYear])
            ->count(); 

        $PreviousYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$previousYear])
            ->count(); 
        
        if(!$PreviousYearManagers==0){
          $ManagersPercentage=($CurrentYearManagers - $PreviousYearManagers) / $PreviousYearManagers *100;
        }else{
          $ManagersPercentage=100;
        }    
            
        $numberOfManagers=DB::table('users')
            ->whereIn('id',$managerIds)
            ->count();   

        $diseases=Disease::count();

        $farmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->get();

        //Farmers percentage calculation
        $CurrentYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                           ->whereRaw('YEAR(farmers.created_at)=?',[$currentYear])
                           ->count();
                           
        $PreviousYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                            ->whereRaw('YEAR(farmers.created_at)=?',[$previousYear])
                            ->count();
              
        if(!$PreviousYearFarmers==0){
          $FarmersPercentage=($CurrentYearFarmers - $PreviousYearFarmers)/ $PreviousYearFarmers * 100;
        }else{
          $FarmersPercentage=100;
        }                    
                            

        $numberOfFarmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->count();

        $numberOfCooperatives=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->count();
       //Current and previous year cooperatives
        $CurrentYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$currentYear])
        ->count();
        $PreviousYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$previousYear])
        ->count();
        //Percentage of Cooperative increase comparing current and previous year
        if(!$PreviousYearCoop==0){
          $coopPercentage=($CurrentYearCoop - $PreviousYearCoop) / $PreviousYearCoop * 100;
        }else{
          $coopPercentage=100;
        }

        $MaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleManagersCount=$MaleManagers->count();              
    
        $MaleManagersByYearMonth = $MaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleManagerMonthYear=[];
        $MaleManagercount=[]; 
        
        foreach ($MaleManagersByYearMonth as $yearMonth => $maleManagers) {
          $MaleManagerMonthYear[]=$yearMonth;
          $MaleManagercount[]= count($maleManagers);
        }

        $FemaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleManagersCount=$FemaleManagers->count();              
    
        $FemaleManagersByYearMonth = $FemaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleManagerMonthYear=[];
        $FemaleManagercount=[]; 
        
        foreach ($FemaleManagersByYearMonth as $yearMonth => $femaleManagers) {
          $FemaleManagerMonthYear[]=$yearMonth;
          $FemaleManagercount[]= count($femaleManagers);
        }

        $MaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleFarmersCount=$MaleFarmers->count();              
    
        $MaleFarmersByYearMonth = $MaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleFarmerMonthYear=[];
        $MaleFarmercount=[]; 
        
        foreach ($MaleFarmersByYearMonth as $yearMonth => $maleFarmers) {
          $MaleFarmerMonthYear[]=$yearMonth;
          $MaleFarmercount[]= count($maleFarmers);
        }

        $FemaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleFarmersCount=$FemaleFarmers->count();              
    
        $FemaleFarmersByYearMonth = $FemaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleFarmerMonthYear=[];
        $FemaleFarmercount=[]; 
        
        foreach ($FemaleFarmersByYearMonth as $yearMonth => $femaleFarmers) {
          $FemaleFarmerMonthYear[]=$yearMonth;
          $FemaleFarmercount[]= count($femaleFarmers);
        }

        $ActiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
                      ->where('status','Operating')
                      ->get();
        $ActiveCooperativesCount=$ActiveCooperatives->count();              
    
        $ActiveByYearMonth = $ActiveCooperatives->groupBy(function ($coop) {
                    return $coop->created_at->format('Y-m');
                    });
        
        $ActiveCoopMonthYear=[];
        $ActiveCoopcount=[]; 
        
        foreach ($ActiveByYearMonth as $yearMonth => $activecoop) {
          $ActiveCoopMonthYear[]=$yearMonth;
          $ActiveCoopcount[]= count($activecoop);
        }

        $InactiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
        ->where('status','Not operating')
        ->get();
        $InactiveCooperativesCount=$InactiveCooperatives->count();

        $InactiveByYearMonth = $InactiveCooperatives->groupBy(function ($coop) {
              return $coop->created_at->format('Y-m');
              });

        $InactiveCoopMonthYear=[];
        $InactiveCoopcount=[]; 

        foreach ($InactiveByYearMonth as $yearMonth => $inactivecoop) {
        $InactiveCoopMonthYear[]=$yearMonth;
        $InactiveCoopcount[]= count($inactivecoop);
        }

        $Totaldiseases = DB::table('diseases')
                ->select('category', DB::raw('COUNT(*) as current_month_total'))
                ->groupBy('category')
                ->get();

        $TotalReportedDiseases= DB::table('reported_diseases')    
                ->whereIn('cooperative_id',$cooperativeIds)
                ->count(); 
                
        $percentByDiseaseCategory =DB::table('diseases')
                               ->select('diseases.id', 'diseases.disease_name as disease_name', DB::raw('ROUND(COUNT(reported_diseases.id) * 100 / SUM(COUNT(*)) OVER(), 0) AS percentage'))
                               ->join('reported_diseases', 'diseases.id', '=', 'reported_diseases.disease_id')
                               ->whereIn('reported_diseases.cooperative_id',$cooperativeIds)
                               ->groupBy('diseases.id','disease_name')
                               ->orderBy('percentage', 'desc')
                               ->get();
                               
        
        $DiseaseCategoryPercentage = DB::table('reported_diseases')
                              ->select('disease_category', DB::raw('ROUND(COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) AS percentage'))
                              ->whereIn('cooperative_id',$cooperativeIds)
                              ->groupBy('disease_category')
                              ->get();
        
        return view('Official/Dashboard',['numberOfCooperatives'=>$numberOfCooperatives,'numberOfFarmers'=>$numberOfFarmers,
        'diseases'=>$diseases,'profileImg'=>$profileImg,'numberOfManagers'=>$numberOfManagers,'coopPercentage'=>$coopPercentage,
        'ManagersPercentage'=>$ManagersPercentage,'FarmersPercentage'=>$FarmersPercentage,'MaleManagerMonthYear'=>$MaleManagerMonthYear,
        'MaleManagercount'=>$MaleManagercount,'FemaleManagerMonthYear'=>$FemaleManagerMonthYear,'FemaleManagercount'=>$FemaleManagercount,
        'MaleFarmerMonthYear'=>$MaleFarmerMonthYear,'MaleFarmercount'=>$MaleFarmercount,'FemaleFarmerMonthYear'=>$FemaleFarmerMonthYear,
        'FemaleFarmercount'=>$FemaleFarmercount,'ActiveCoopMonthYear'=>$ActiveCoopMonthYear,'ActiveCoopcount'=>$ActiveCoopcount,'TotalReportedDiseases'=>$TotalReportedDiseases,
        'InactiveCoopMonthYear'=>$InactiveCoopMonthYear,'InactiveCoopcount'=>$InactiveCoopcount,'Totaldiseases'=>$Totaldiseases,'percentByDiseaseCategory'=>$percentByDiseaseCategory,
        'DiseaseCategoryPercentage'=>$DiseaseCategoryPercentage,'MaleManagersCount'=>$MaleManagersCount,'FemaleManagersCount'=>$FemaleManagersCount,'MaleFarmersCount'=>$MaleFarmersCount,
        'FemaleFarmersCount'=>$FemaleFarmersCount,'ActiveCooperativesCount'=>$ActiveCooperativesCount,'InactiveCooperativesCount'=>$InactiveCooperativesCount]);
      }
      elseif($user_role==="District-agro"){
        $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
             ->whereIn('district', $users_location->pluck('district'))
             ->get();
        $cooperativeIds = $Cooperatives->pluck('id');

        $managerIds = DB::table('cooperative_user')
            ->whereIn('cooperative_id', $cooperativeIds)
            ->pluck('user_id');

        $farmerIds = DB::table('farmers') 
                    ->whereIn('cooperative_id',$cooperativeIds)
                    ->pluck('id');
                       
        
        $managers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->get();
            

        //Managers percentage 
        $CurrentYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$currentYear])
            ->count(); 

        $PreviousYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$previousYear])
            ->count(); 
        
        if(!$PreviousYearManagers==0){
          $ManagersPercentage=($CurrentYearManagers - $PreviousYearManagers) / $PreviousYearManagers *100;
        }else{
          $ManagersPercentage=100;
        }    
            
        $numberOfManagers=DB::table('users')
            ->whereIn('id',$managerIds)
            ->count();   

        $diseases=Disease::count();

        $farmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->get();

        //Farmers percentage calculation
        $CurrentYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                           ->whereRaw('YEAR(farmers.created_at)=?',[$currentYear])
                           ->count();
                           
        $PreviousYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                            ->whereRaw('YEAR(farmers.created_at)=?',[$previousYear])
                            ->count();
              
        if(!$PreviousYearFarmers==0){
          $FarmersPercentage=($CurrentYearFarmers - $PreviousYearFarmers)/ $PreviousYearFarmers * 100;
        }else{
          $FarmersPercentage=100;
        }                    
                            

        $numberOfFarmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->count();

        $numberOfCooperatives=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->count();
       //Current and previous year cooperatives
        $CurrentYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$currentYear])
        ->count();
        $PreviousYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$previousYear])
        ->count();
        //Percentage of Cooperative increase comparing current and previous year
        if(!$PreviousYearCoop==0){
          $coopPercentage=($CurrentYearCoop - $PreviousYearCoop) / $PreviousYearCoop * 100;
        }else{
          $coopPercentage=100;
        }

        $MaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleManagersCount=$MaleManagers->count();             
    
        $MaleManagersByYearMonth = $MaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleManagerMonthYear=[];
        $MaleManagercount=[]; 
        
        foreach ($MaleManagersByYearMonth as $yearMonth => $maleManagers) {
          $MaleManagerMonthYear[]=$yearMonth;
          $MaleManagercount[]= count($maleManagers);
        }

        $FemaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleManagersCount=$FemaleManagers->count();              
    
        $FemaleManagersByYearMonth = $FemaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleManagerMonthYear=[];
        $FemaleManagercount=[]; 
        
        foreach ($FemaleManagersByYearMonth as $yearMonth => $femaleManagers) {
          $FemaleManagerMonthYear[]=$yearMonth;
          $FemaleManagercount[]= count($femaleManagers);
        }

        $MaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleFarmersCount=$MaleFarmers->count();             
    
        $MaleFarmersByYearMonth = $MaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleFarmerMonthYear=[];
        $MaleFarmercount=[]; 
        
        foreach ($MaleFarmersByYearMonth as $yearMonth => $maleFarmers) {
          $MaleFarmerMonthYear[]=$yearMonth;
          $MaleFarmercount[]= count($maleFarmers);
        }

        $FemaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleFarmersCount=$FemaleFarmers->count();              
    
        $FemaleFarmersByYearMonth = $FemaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleFarmerMonthYear=[];
        $FemaleFarmercount=[]; 
        
        foreach ($FemaleFarmersByYearMonth as $yearMonth => $femaleFarmers) {
          $FemaleFarmerMonthYear[]=$yearMonth;
          $FemaleFarmercount[]= count($femaleFarmers);
        }

        $ActiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
                      ->where('status','Operating')
                      ->get();
        $ActiveCooperativesCount=$ActiveCooperatives->count();              
    
        $ActiveByYearMonth = $ActiveCooperatives->groupBy(function ($coop) {
                    return $coop->created_at->format('Y-m');
                    });
        
        $ActiveCoopMonthYear=[];
        $ActiveCoopcount=[]; 
        
        foreach ($ActiveByYearMonth as $yearMonth => $activecoop) {
          $ActiveCoopMonthYear[]=$yearMonth;
          $ActiveCoopcount[]= count($activecoop);
        }

        $InactiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
        ->where('status','Not operating')
        ->get();
        $InactiveCooperativesCount=$InactiveCooperatives->count();

        $InactiveByYearMonth = $InactiveCooperatives->groupBy(function ($coop) {
              return $coop->created_at->format('Y-m');
              });

        $InactiveCoopMonthYear=[];
        $InactiveCoopcount=[]; 

        foreach ($InactiveByYearMonth as $yearMonth => $inactivecoop) {
        $InactiveCoopMonthYear[]=$yearMonth;
        $InactiveCoopcount[]= count($inactivecoop);
        }

        $Totaldiseases = DB::table('diseases')
                  ->select('category', DB::raw('COUNT(*) as current_month_total'))
                  ->groupBy('category')
                  ->get();
        
        $TotalReportedDiseases= DB::table('reported_diseases')    
                  ->whereIn('cooperative_id',$cooperativeIds)
                  ->count();           
        
        $percentByDiseaseCategory =DB::table('diseases')
                  ->select('diseases.id', 'diseases.disease_name as disease_name', DB::raw('ROUND(COUNT(reported_diseases.id) * 100 / SUM(COUNT(*)) OVER(), 0) AS percentage'))
                  ->join('reported_diseases', 'diseases.id', '=', 'reported_diseases.disease_id')
                  ->whereIn('reported_diseases.cooperative_id',$cooperativeIds)
                  ->groupBy('diseases.id','disease_name')
                  ->orderBy('percentage', 'desc')
                  ->get();
                  

        $DiseaseCategoryPercentage = DB::table('reported_diseases')
                 ->select('disease_category', DB::raw('ROUND(COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) AS percentage'))
                 ->whereIn('cooperative_id',$cooperativeIds)
                 ->groupBy('disease_category')
                 ->get();
                  
        return view('Official/Dashboard',['numberOfCooperatives'=>$numberOfCooperatives,'numberOfFarmers'=>$numberOfFarmers,
        'diseases'=>$diseases,'profileImg'=>$profileImg,'numberOfManagers'=>$numberOfManagers,'coopPercentage'=>$coopPercentage,
        'ManagersPercentage'=>$ManagersPercentage,'FarmersPercentage'=>$FarmersPercentage,'MaleManagerMonthYear'=>$MaleManagerMonthYear,
        'MaleManagercount'=>$MaleManagercount,'FemaleManagerMonthYear'=>$FemaleManagerMonthYear,'FemaleManagercount'=>$FemaleManagercount,
        'MaleFarmerMonthYear'=>$MaleFarmerMonthYear,'MaleFarmercount'=>$MaleFarmercount,'FemaleFarmerMonthYear'=>$FemaleFarmerMonthYear,
        'FemaleFarmercount'=>$FemaleFarmercount,'ActiveCoopMonthYear'=>$ActiveCoopMonthYear,'ActiveCoopcount'=>$ActiveCoopcount,'Totaldiseases'=>$Totaldiseases,
        'InactiveCoopMonthYear'=>$InactiveCoopMonthYear,'InactiveCoopcount'=>$InactiveCoopcount,'diseasesReported'=>$diseasesReported,'TotalReportedDiseases'=>$TotalReportedDiseases,
        'percentByDiseaseCategory'=>$percentByDiseaseCategory,'DiseaseCategoryPercentage'=>$DiseaseCategoryPercentage,'MaleManagersCount'=>$MaleManagersCount,'FemaleManagersCount'=>$FemaleManagersCount,
        'MaleFarmersCount'=>$MaleFarmersCount,'FemaleFarmersCount'=>$FemaleFarmersCount,'ActiveCooperativesCount'=>$ActiveCooperativesCount,
        'InactiveCooperativesCount'=>$InactiveCooperativesCount]);
      }else{
        $Cooperatives = Cooperative::all();
        $cooperativeIds = $Cooperatives->pluck('id');

        $managerIds = DB::table('cooperative_user')
            ->whereIn('cooperative_id', $cooperativeIds)
            ->pluck('user_id');

        $farmerIds = DB::table('farmers') 
                    ->whereIn('cooperative_id',$cooperativeIds)
                    ->pluck('id');
                       
        
        $managers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->get();

        //Managers percentage 
        $CurrentYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$currentYear])
            ->count(); 

        $PreviousYearManagers= DB::table('users')
            ->whereIn('id',$managerIds)
            ->whereRaw('YEAR(users.created_at)=?',[$previousYear])
            ->count(); 
        
        if(!$PreviousYearManagers==0){
          $ManagersPercentage=($CurrentYearManagers - $PreviousYearManagers) / $PreviousYearManagers *100;
        }else{
          $ManagersPercentage=100;
        }    
            
        $numberOfManagers=DB::table('users')
            ->whereIn('id',$managerIds)
            ->count();   

        $diseases=Disease::count();

        $farmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->get();

        //Farmers percentage calculation
        $CurrentYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                           ->whereRaw('YEAR(farmers.created_at)=?',[$currentYear])
                           ->count();
                           
        $PreviousYearFarmers=Farmer::whereIn('cooperative_id',$cooperativeIds)
                            ->whereRaw('YEAR(farmers.created_at)=?',[$previousYear])
                            ->count();
              
        if(!$PreviousYearFarmers==0){
          $FarmersPercentage=($CurrentYearFarmers - $PreviousYearFarmers)/ $PreviousYearFarmers * 100;
        }else{
          $FarmersPercentage=100;
        }                    
                            

        $numberOfFarmers = Farmer::whereIn('cooperative_id', $cooperativeIds)->count();

        $numberOfCooperatives=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->count();
       //Current and previous year cooperatives
        $CurrentYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$currentYear])
        ->count();
        $PreviousYearCoop=Cooperative::whereIn('province', $users_location->pluck('province'))
        ->whereIn('district', $users_location->pluck('district'))
        ->whereIn('sector', $users_location->pluck('sector'))
        ->whereIn('cell', $users_location->pluck('cell'))
        ->whereRaw('YEAR(cooperatives.created_at) = ?', [$previousYear])
        ->count();
        //Percentage of Cooperative increase comparing current and previous year
        if(!$PreviousYearCoop==0){
          $coopPercentage=($CurrentYearCoop - $PreviousYearCoop) / $PreviousYearCoop * 100;
        }else{
          $coopPercentage=100;
        }

        $MaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleManagersCount=$MaleManagers->count();              
    
        $MaleManagersByYearMonth = $MaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleManagerMonthYear=[];
        $MaleManagercount=[]; 
        
        foreach ($MaleManagersByYearMonth as $yearMonth => $maleManagers) {
          $MaleManagerMonthYear[]=$yearMonth;
          $MaleManagercount[]= count($maleManagers);
        }

        $FemaleManagers=User::whereIn('id',$managerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleManagersCount=$FemaleManagers->count();              
    
        $FemaleManagersByYearMonth = $FemaleManagers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleManagerMonthYear=[];
        $FemaleManagercount=[]; 
        
        foreach ($FemaleManagersByYearMonth as $yearMonth => $femaleManagers) {
          $FemaleManagerMonthYear[]=$yearMonth;
          $FemaleManagercount[]= count($femaleManagers);
        }

        $MaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Male')
                      ->get();
        $MaleFarmersCount=$MaleFarmers->count();              
    
        $MaleFarmersByYearMonth = $MaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $MaleFarmerMonthYear=[];
        $MaleFarmercount=[]; 
        
        foreach ($MaleFarmersByYearMonth as $yearMonth => $maleFarmers) {
          $MaleFarmerMonthYear[]=$yearMonth;
          $MaleFarmercount[]= count($maleFarmers);
        }

        $FemaleFarmers=Farmer::whereIn('id',$farmerIds)
                      ->where('gender','Female')
                      ->get();
        $FemaleFarmersCount=$FemaleFarmers->count();             
    
        $FemaleFarmersByYearMonth = $FemaleFarmers->groupBy(function ($user) {
                    return $user->created_at->format('Y-m');
                    });
        
        $FemaleFarmerMonthYear=[];
        $FemaleFarmercount=[]; 
        
        foreach ($FemaleFarmersByYearMonth as $yearMonth => $femaleFarmers) {
          $FemaleFarmerMonthYear[]=$yearMonth;
          $FemaleFarmercount[]= count($femaleFarmers);
        }

        $ActiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
                      ->where('status','Operating')
                      ->get();
        $ActiveCooperativesCount=$ActiveCooperatives->count();              
    
        $ActiveByYearMonth = $ActiveCooperatives->groupBy(function ($coop) {
                    return $coop->created_at->format('Y-m');
                    });
        
        $ActiveCoopMonthYear=[];
        $ActiveCoopcount=[]; 
        
        foreach ($ActiveByYearMonth as $yearMonth => $activecoop) {
          $ActiveCoopMonthYear[]=$yearMonth;
          $ActiveCoopcount[]= count($activecoop);
        }

        $InactiveCooperatives=Cooperative::whereIn('id',$cooperativeIds)
        ->where('status','Not operating')
        ->get();
        $InactiveCooperativesCount=$InactiveCooperatives->count();

        $InactiveByYearMonth = $InactiveCooperatives->groupBy(function ($coop) {
              return $coop->created_at->format('Y-m');
              });

        $InactiveCoopMonthYear=[];
        $InactiveCoopcount=[]; 

        foreach ($InactiveByYearMonth as $yearMonth => $inactivecoop) {
        $InactiveCoopMonthYear[]=$yearMonth;
        $InactiveCoopcount[]= count($inactivecoop);
        }

        $Totaldiseases = DB::table('diseases')
                  ->select('category', DB::raw('COUNT(*) as current_month_total'))
                  ->groupBy('category')
                  ->get();
        
        $TotalReportedDiseases=ReportedDisease::count();

        $percentByDiseaseCategory =DB::table('diseases')
                        ->select('diseases.id', 'diseases.disease_name as disease_name', DB::raw('ROUND(COUNT(reported_diseases.id) * 100 / SUM(COUNT(*)) OVER(), 0) AS percentage'))
                        ->join('reported_diseases', 'diseases.id', '=', 'reported_diseases.disease_id')
                        ->groupBy('diseases.id','disease_name')
                        ->orderBy('percentage', 'desc')
                        ->get();

        $DiseaseCategoryPercentage = DB::table('reported_diseases')
                            ->select('disease_category', DB::raw('ROUND(COUNT(*) * 100.0 / SUM(COUNT(*)) OVER ()) AS percentage'))
                            ->groupBy('disease_category')
                            ->get();    
   

        
        return view('Official/Dashboard',['numberOfCooperatives'=>$numberOfCooperatives,'numberOfFarmers'=>$numberOfFarmers,
        'diseases'=>$diseases,'profileImg'=>$profileImg,'numberOfManagers'=>$numberOfManagers,'coopPercentage'=>$coopPercentage,
        'ManagersPercentage'=>$ManagersPercentage,'FarmersPercentage'=>$FarmersPercentage,'MaleManagerMonthYear'=>$MaleManagerMonthYear,
        'MaleManagercount'=>$MaleManagercount,'FemaleManagerMonthYear'=>$FemaleManagerMonthYear,'FemaleManagercount'=>$FemaleManagercount,
        'MaleFarmerMonthYear'=>$MaleFarmerMonthYear,'MaleFarmercount'=>$MaleFarmercount,'FemaleFarmerMonthYear'=>$FemaleFarmerMonthYear,
        'FemaleFarmercount'=>$FemaleFarmercount,'ActiveCoopMonthYear'=>$ActiveCoopMonthYear,'ActiveCoopcount'=>$ActiveCoopcount,
        'InactiveCoopMonthYear'=>$InactiveCoopMonthYear,'InactiveCoopcount'=>$InactiveCoopcount,'Totaldiseases'=>$Totaldiseases,
        'TotalReportedDiseases'=>$TotalReportedDiseases,'percentByDiseaseCategory'=>$percentByDiseaseCategory,
        'DiseaseCategoryPercentage'=>$DiseaseCategoryPercentage,'MaleManagersCount'=>$MaleManagersCount,'FemaleManagersCount'=>$FemaleManagersCount,
        'MaleFarmersCount'=>$MaleFarmersCount,'FemaleFarmersCount'=>$FemaleFarmersCount,'ActiveCooperativesCount'=>$ActiveCooperativesCount,
        'InactiveCooperativesCount'=>$InactiveCooperativesCount]);
      }
    }
    
    public function ManagerProfile($id){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      $ManagerDetails=User::find($id);
      return view('Official/Manager-details',['ManagerDetails'=>$ManagerDetails,'profileImg'=>$profileImg]);     
    }

  public function OfficialCooperativeView($id){
    $userId =auth()->user()->id;
    $profileImg=User::find($userId);
    $cooperativeinfo=Cooperative::find($id);
    $cooperative_farmers=Farmer::where('cooperative_id',$id)->count();
    $females=Farmer::where(['cooperative_id'=>$id,'gender'=>'Female'])->count();
    $males=Farmer::where(['cooperative_id'=>$id,'gender'=>'Male'])->count();
    $femalePercentage=Round(($females/$cooperative_farmers)*100,2);
    $malepercentage=Round(($males/$cooperative_farmers)*100,2);
   
    $diseasesReported = DB::table('reported_diseases')
        ->select('disease_id', DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
        ->where('cooperative_id', $id)
        ->groupBy('disease_id', 'year')
        ->get();     

$total_quantity = DB::table('stocks')
->where('cooperative_id', $id)
->sum('quantity');

$quantities_by_category = DB::table('stocks')
->select('product', DB::raw('SUM(quantity) as total_quantity'))
->where('cooperative_id', $id)
->groupBy('product')
->get();

$percentages_by_category = [];
foreach ($quantities_by_category as $category) {
$percentage = Round(($category->total_quantity / $total_quantity) * 100,2);
$percentages_by_category[$category->product] = $percentage;
}

$diseases = DB::table('reported_diseases')
->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
->select(DB::raw('YEAR(reported_diseases.created_at) as year'), 'reported_diseases.disease_id', 'diseases.disease_name', DB::raw('COUNT(*) as count'))
->where('reported_diseases.cooperative_id',$id)
->groupBy('year', 'reported_diseases.disease_id', 'diseases.disease_name')
->orderBy('year')
->get();


    return view('Official/Cooperative-details',['cooperativeinfo'=>$cooperativeinfo,'profileImg'=>$profileImg,
    'cooperative_farmers'=>$cooperative_farmers,'femalePercentage'=>$femalePercentage,
    'malePercentage'=>$malepercentage,'percentages_by_category'=>$percentages_by_category,
    'diseases'=>$diseases]);
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
            ->select('users.id as user_id','users.name as manager_name', 'cooperatives.name as cooperative_name','users.created_at')
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

      public function OfficialFarmerView($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $farmerinfo=Farmer::find($id);
        return view('Official/Farmer-details',['farmerinfo'=>$farmerinfo,'profileImg'=>$profileImg]);
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

      public function DiseaseDetailsPage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $diseaseinfo=Disease::find($id);
        return view('Official/Disease-details',['diseaseinfo'=>$diseaseinfo,'profileImg'=>$profileImg]);
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
                
          $DiseaseReported = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw("DATE_FORMAT(reported_diseases.created_at, '%Y-%m') as YearMonth, diseases.disease_name, COUNT(*) as count"))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->groupBy('YearMonth', 'diseases.disease_name')
                ->get();         
          
          $no=0;

          $districts = [
            // ['name' => 'Kigali City', 'latitude' => -1.9536 , 'longitude' => 30.0605],
            ['name' => 'Gasabo', 'latitude' => -1.9543 , 'longitude' => 30.1358 ],
            ['name' => 'Kicukiro', 'latitude' => -1.9906, 'longitude' => 30.1256],
            ['name' => 'Nyarugenge', 'latitude' => -1.9544, 'longitude' => 30.0604],

            ['name' => 'Nyanza', 'latitude' => -2.3418 , 'longitude' => 29.7381],
            ['name' => 'Huye', 'latitude' => -2.5061, 'longitude' => 29.6919],
            ['name' => 'Gisagara', 'latitude' => -2.4874, 'longitude' => 29.5266],
            ['name' => 'Kamonyi', 'latitude' => -2.0618, 'longitude' =>  29.8649],
            ['name' => 'Muhanga', 'latitude' => -2.0061, 'longitude' => 29.7386],
            ['name' => 'Ruhango', 'latitude' => -2.1459, 'longitude' => 29.7753],
            ['name' => 'Nyamagabe', 'latitude' => -2.4687, 'longitude' => 29.5837],
            ['name' => 'Nyaruguru', 'latitude' => -2.5853, 'longitude' => 29.5735],

            ['name' => 'Karongi', 'latitude' => -2.1543, 'longitude' => 29.3688],
            ['name' => 'Ngororero', 'latitude' => -2.5022, 'longitude' => 29.5645],
            ['name' => 'Nyabihu', 'latitude' => -1.6705, 'longitude' => 29.3594],
            ['name' => 'Nyamasheke', 'latitude' => -2.3356, 'longitude' => 29.1196],
            ['name' => 'Rubavu', 'latitude' => -1.5074, 'longitude' => 29.6309],
            ['name' => 'Rusizi', 'latitude' => -2.4702, 'longitude' => 28.9092],
            ['name' => 'Rutsiro', 'latitude' => -2.0736, 'longitude' => 29.1937],

            ['name' => 'Burera', 'latitude' => -1.5986, 'longitude' => 29.6316],
            ['name' => 'Gakenke', 'latitude' => -1.7326, 'longitude' => 29.8046],
            ['name' => 'Gicumbi', 'latitude' => -1.6850, 'longitude' => 30.0642],
            ['name' => 'Musanze', 'latitude' => -1.5012, 'longitude' => 29.6359 ],
            ['name' => 'Rulindo', 'latitude' => -1.6361, 'longitude' => 30.1165],
                  
            ['name' => 'Bugesera', 'latitude' => -2.1841, 'longitude' => 30.0512],
            ['name' => 'Gatsibo', 'latitude' => -1.6756, 'longitude' => 30.4091],
            ['name' => 'Kayonza', 'latitude' => -1.8623, 'longitude' => 30.5663],
            ['name' => 'Kirehe', 'latitude' => -2.1581, 'longitude' => 30.5424],
            ['name' => 'Ngoma', 'latitude' => -2.1965, 'longitude' => 30.5285],
            ['name' => 'Nyagatare', 'latitude' => -1.3121, 'longitude' => 30.4212],
            ['name' => 'Rwamagana', 'latitude' => -1.9514, 'longitude' => 30.4384],
        ];

          return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
          'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts,'districts'=>$districts,'DiseaseReported'=>$DiseaseReported]);
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
                
          $DiseaseReported = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw("DATE_FORMAT(reported_diseases.created_at, '%Y-%m') as YearMonth, diseases.disease_name, COUNT(*) as count"))
                ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                ->groupBy('YearMonth', 'diseases.disease_name')
                ->get();      

          $no=0;

          return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
          'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts,'DiseaseReported'=>$DiseaseReported]);
        }
        elseif($user_role==="District-agro"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                        ->whereIn('district', $users_location->pluck('district'))
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

          $districts = [
                  // ['name' => 'Kigali City', 'latitude' => -1.9536 , 'longitude' => 30.0605],
                  ['name' => 'Gasabo', 'latitude' => -1.9543 , 'longitude' => 30.1358 ],
                  ['name' => 'Kicukiro', 'latitude' => -1.9906, 'longitude' => 30.1256],
                  ['name' => 'Nyarugenge', 'latitude' => -1.9544, 'longitude' => 30.0604],

                  ['name' => 'Nyanza', 'latitude' => -2.3418 , 'longitude' => 29.7381],
                  ['name' => 'Huye', 'latitude' => -2.5061, 'longitude' => 29.6919],
                  ['name' => 'Gisagara', 'latitude' => -2.4874, 'longitude' => 29.5266],
                  ['name' => 'Kamonyi', 'latitude' => -2.0618, 'longitude' =>  29.8649],
                  ['name' => 'Muhanga', 'latitude' => -2.0061, 'longitude' => 29.7386],
                  ['name' => 'Ruhango', 'latitude' => -2.1459, 'longitude' => 29.7753],
                  ['name' => 'Nyamagabe', 'latitude' => -2.4687, 'longitude' => 29.5837],
                  ['name' => 'Nyaruguru', 'latitude' => -2.5853, 'longitude' => 29.5735],

                  ['name' => 'Karongi', 'latitude' => -2.1543, 'longitude' => 29.3688],
                  ['name' => 'Ngororero', 'latitude' => -2.5022, 'longitude' => 29.5645],
                  ['name' => 'Nyabihu', 'latitude' => -1.6705, 'longitude' => 29.3594],
                  ['name' => 'Nyamasheke', 'latitude' => -2.3356, 'longitude' => 29.1196],
                  ['name' => 'Rubavu', 'latitude' => -1.5074, 'longitude' => 29.6309],
                  ['name' => 'Rusizi', 'latitude' => -2.4702, 'longitude' => 28.9092],
                  ['name' => 'Rutsiro', 'latitude' => -2.0736, 'longitude' => 29.1937],

                  ['name' => 'Burera', 'latitude' => -1.5986, 'longitude' => 29.6316],
                  ['name' => 'Gakenke', 'latitude' => -1.7326, 'longitude' => 29.8046],
                  ['name' => 'Gicumbi', 'latitude' => -1.6850, 'longitude' => 30.0642],
                  ['name' => 'Musanze', 'latitude' => -1.5014, 'longitude' =>  29.6317],
                  ['name' => 'Rulindo', 'latitude' => -1.6361, 'longitude' => 30.1165],
                        
                  ['name' => 'Bugesera', 'latitude' => -2.1841, 'longitude' => 30.0512],
                  ['name' => 'Gatsibo', 'latitude' => -1.6756, 'longitude' => 30.4091],
                  ['name' => 'Kayonza', 'latitude' => -1.8623, 'longitude' => 30.5663],
                  ['name' => 'Kirehe', 'latitude' => -2.1581, 'longitude' => 30.5424],
                  ['name' => 'Ngoma', 'latitude' => -2.1965, 'longitude' => 30.5285],
                  ['name' => 'Nyagatare', 'latitude' => -1.3121, 'longitude' => 30.4212],
                  ['name' => 'Rwamagana', 'latitude' => -1.9514, 'longitude' => 30.4384],
              ];

              $reportedDiseases = DB::table('reported_disease')
                    ->select(DB::raw('count(*) as count, disease_id, DATE_FORMAT(created_at, "%Y-%m") as month_year'))
                    ->groupBy('disease_id', 'month_year')
                    ->orderBy('month_year')
                    ->get();

              $DiseaseReported = DB::table('reported_diseases')
                    ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                    ->select(DB::raw("DATE_FORMAT(reported_diseases.created_at, '%Y-%m') as YearMonth, diseases.disease_name, COUNT(*) as count"))
                    ->whereIn('reported_diseases.cooperative_id', $cooperativeIds)
                    ->groupBy('YearMonth', 'diseases.disease_name')
                    ->get();   

          $no=0;

          return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
          'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts,'DiseaseReported'=>$DiseaseReported]);
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

        $DiseaseReported = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw("DATE_FORMAT(reported_diseases.created_at, '%Y-%m') as YearMonth, diseases.disease_name, COUNT(*) as count"))
                ->groupBy('YearMonth', 'diseases.disease_name')
                ->get();

        $no=0;     

        return view('Official/Diseases',['profileImg'=>$profileImg,'monthlyCounts'=>$monthlyCounts,
        'no'=>$no,'diseases'=>$diseases,'yearlyCounts'=>$yearlyCounts,'DiseaseReported'=>$DiseaseReported]);        
        }
      }
       
      public function getAnalytics(){

      }
}
