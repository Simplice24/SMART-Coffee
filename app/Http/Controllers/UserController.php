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
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use PDF;
use session;


class UserController extends Controller
{

    public function Dashboard(){
      $userId =auth()->user()->id;
      $profileImg=User::find($userId);
      $rows=User::count();
      $farmer=Farmer::count();
      $cooperative=Cooperative::count();
      $disease=Disease::count();
      $maleUsers = User::where('gender', 'male')->get();
      $CountingMale=count($maleUsers);
      $femaleUsers = User::where('gender', 'female')->get();
      $CountingFemale=count($femaleUsers);
      $malefarmers = Farmer::where('gender', 'male')->get();
      $CountingMaleFarmers=count($malefarmers);
      $femalefarmers = Farmer::where('gender', 'female')->get();
      $CountingFemaleFarmers=count($femalefarmers);
      $activeCoop= Cooperative::where('status','Operating')->get();
      $activeCount=count($activeCoop);
      $inactiveCoop= Cooperative::where('status','Not operating')->get();
      $inactiveCount=count($inactiveCoop);

      $currentMonth = date('m');
      $currentYear = date('Y');

      $diseases = DB::table('diseases')
      ->select('category', DB::raw('COUNT(*) as current_month_total'))
      ->groupBy('category')
      ->get();

      $previousMonth = $currentMonth - 1;
      $previousYear = $currentYear;

      $previousMonthDiseases = DB::table('diseases')
      ->select('category', DB::raw('COUNT(*) as previous_month_total'))
      ->whereMonth('created_at', $previousMonth)
      ->whereYear('created_at', $currentYear)
      ->groupBy('category')
      ->get();

if ($previousMonth == 0) {
    $previousMonth = 12;
    $previousYear -= 1;
}

$currentMonthCount = DB::table('diseases')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count();

$UserscurrentMonthCount = DB::table('users')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count();

$FarmerscurrentMonthCount = DB::table('farmers')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count();
            
$CooperativescurrentMonthCount = DB::table('cooperatives')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count();

$previousMonthCount = DB::table('diseases')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

$UserspreviousMonthCount = DB::table('users')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

$FarmerspreviousMonthCount = DB::table('farmers')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

$CooperativespreviousMonthCount = DB::table('cooperatives')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                    $MaleUserscurrentMonthCount = DB::table('users')
                    ->where('gender', 'Male')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(); 
                    
                    $MaleUserspreviousMonthCount = DB::table('users')
                    ->where('gender', 'Male')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                    $FemaleUserscurrentMonthCount = DB::table('users')
                    ->where('gender', 'Female')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(); 
                    
                    $FemaleUserspreviousMonthCount = DB::table('users')
                    ->where('gender', 'Female')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                    $MaleFarmerscurrentMonthCount = DB::table('farmers')
                    ->where('gender', 'Male')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(); 
                    
                    $MaleFarmerspreviousMonthCount = DB::table('farmers')
                    ->where('gender', 'Male')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                    $FemaleFarmerscurrentMonthCount = DB::table('farmers')
                    ->where('gender', 'Female')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(); 
                    
                    $FemaleFarmerspreviousMonthCount = DB::table('farmers')
                    ->where('gender', 'Female')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                    $FemaleFarmerscurrentMonthCount = DB::table('farmers')
                    ->where('gender', 'Female')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(); 
                    
                    $FemaleFarmerspreviousMonthCount = DB::table('farmers')
                    ->where('gender', 'Female')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                    $ActiveCoopcurrentMonthCount = DB::table('cooperatives')
                    ->where('status', 'Operating')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(); 
                    
                    $ActiveCooppreviousMonthCount = DB::table('cooperatives')
                    ->where('status', 'Not operating')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                    $InactiveCoopcurrentMonthCount = DB::table('cooperatives')
                    ->where('status', 'Not operating')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count(); 
                    
                    $InactiveCooppreviousMonthCount = DB::table('cooperatives')
                    ->where('status', 'Not operating')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();


if($CooperativescurrentMonthCount==0){
$CooperativespercentIncrease=0;
}else if($CooperativespreviousMonthCount==0){
  $CooperativespercentIncrease=100;
}else{
$CooperativespercentIncrease = ($CooperativescurrentMonthCount - $CooperativespreviousMonthCount) / $CooperativespreviousMonthCount * 100;
}  

if($FemaleUserscurrentMonthCount==0){
$FemaleUserspercentIncrease=0;
}else if($FemaleUserspreviousMonthCount==0){
  $FemaleUserspercentIncrease=100;
}else{
$FemaleUserspercentIncrease = ($FemaleUserscurrentMonthCount - $FemaleUserspreviousMonthCount) / $FemaleUserspreviousMonthCount * 100;
} 

if($MaleUserscurrentMonthCount==0){
$MaleUserspercentIncrease=0;
}else if($MaleUserspreviousMonthCount==0){
  $MaleUserspercentIncrease=100;
}else{
$MaleUserspercentIncrease = ($MaleUserscurrentMonthCount - $MaleUserspreviousMonthCount) / $MaleUserspreviousMonthCount * 100;
} 

if($FemaleFarmerscurrentMonthCount==0){
  $FemaleFarmerspercentIncrease=0;
  }else if($FemaleFarmerspreviousMonthCount==0){
    $FemaleFarmerspercentIncrease=100;
  }else{
  $FemaleFarmerspercentIncrease = ($FemaleFarmerscurrentMonthCount - $FemaleFarmerspreviousMonthCount) / $FemaleFarmerspreviousMonthCount * 100;
  } 
  
  if($MaleFarmerscurrentMonthCount==0){
  $MaleFarmerspercentIncrease=0;
  }else if($MaleFarmerspreviousMonthCount==0){
    $MaleFarmerspercentIncrease=100;
  }else{
  $MaleFarmerspercentIncrease = ($MaleFarmerscurrentMonthCount - $MaleFarmerspreviousMonthCount) / $MaleFarmerspreviousMonthCount * 100;
  } 

  if($ActiveCoopcurrentMonthCount==0){
    $ActiveCooperativespercentIncrease=0;
    }else if($ActiveCooppreviousMonthCount==0){
      $ActiveCooperativespercentIncrease=100;
    }else{
    $ActiveCooperativespercentIncrease = ($ActiveCoopcurrentMonthCount - $ActiveCooppreviousMonthCount) / $ActiveCooppreviousMonthCount * 100;
    } 
    
    if($InactiveCoopcurrentMonthCount==0){
    $InactiveCooppercentIncrease=0;
    }else if($InactiveCooppreviousMonthCount==0){
      $InactiveCooppercentIncrease=100;
    }else{
    $InactiveCooppercentIncrease = ($InactiveCoopcurrentMonthCount - $InactiveCooppreviousMonthCount) / $InactiveCooppreviousMonthCount * 100;
    } 

if($FarmerscurrentMonthCount==0){
$FarmerspercentIncrease=0;
}else if($FarmerspreviousMonthCount==0){
$FarmerspercentIncrease=100;
}else{
$FarmerspercentIncrease = ($FarmerscurrentMonthCount - $FarmerspreviousMonthCount) / $FarmerspreviousMonthCount * 100;
}

if($UserscurrentMonthCount==0){
  $UserspercentIncrease=0;
}else if($UserspreviousMonthCount==0){
  $UserspercentIncrease=100;
}else{
  $UserspercentIncrease = ($UserscurrentMonthCount - $UserspreviousMonthCount) / $UserspreviousMonthCount * 100;
}

if($currentMonthCount==0){
  $percentIncrease=0;
}else if($previousMonthCount==0){
  $percentIncrease=100;
}else{
  $percentIncrease = ($currentMonthCount - $previousMonthCount) / $previousMonthCount * 100;
}

      $MaleMonth=[];
      $Malecount=[];
      $FemaleMonth=[];
      $Femalecount=[];
      $MalefarmerMonth=[];
      $MalefarmerCount=[];
      $FemalefarmerMonth=[];
      $Femalefarmercount=[];
      $ActiveCoopMonth=[];
      $ActiveCoopCount=[];
      $InactiveCoopMonth=[];
      $InactiveCoopCount=[];
      $DiseaseCategory=[];
      $CategoryCount=[];

$maleUsersByYearMonth = $maleUsers->groupBy(function ($user) {
return $user->created_at->format('Y-m');
});
$femaleUsersByYearMonth = $femaleUsers->groupBy(function ($user) {
return $user->created_at->format('Y-m');
});
$maleFarmersByYearMonth = $malefarmers->groupBy(function ($user) {
return $user->created_at->format('Y-m');
});
$femaleFarmersByYearMonth = $femalefarmers->groupBy(function ($user) {
  return $user->created_at->format('Y-m');
});
$activeCoopByYearMonth = $activeCoop->groupBy(function ($user) {
  return $user->created_at->format('Y-m');
});
$inactiveCoopByYearMonth = $inactiveCoop->groupBy(function ($user) {
return $user->created_at->format('Y-m');
});

foreach ($maleUsersByYearMonth as $yearMonth => $maleUsers) {
  $MaleMonth[]=$yearMonth;
  $Malecount[]= count($maleUsers);
}
foreach ($femaleUsersByYearMonth as $yearMonth => $femaleUsers) {
  $FemaleMonth[]=$yearMonth;
  $Femalecount[]= count($femaleUsers);
}
foreach ($maleFarmersByYearMonth as $yearMonth => $maleFarmers) {
  $MalefarmerMonth[]=$yearMonth;
  $Malefarmercount[]= count($maleFarmers);
}
foreach ($femaleFarmersByYearMonth as $yearMonth => $femaleFarmers) {
  $FemalefarmerMonth[]=$yearMonth;
  $Femalefarmercount[]= count($femaleFarmers);
}

foreach ($activeCoopByYearMonth as $yearMonth => $active) {
  $ActiveCoopMonth[]=$yearMonth;
  $ActiveCoopCount[]= count($active);
}
foreach ($inactiveCoopByYearMonth as $yearMonth => $inactive) {
  $InactiveCoopMonth[]=$yearMonth;
  $InactiveCoopCount[]= count($inactive);
}

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
   

     return view('Dashboard',['profileImg'=>$profileImg,'rows'=>$rows,'farmer'=>$farmer,'cooperative'=>$cooperative,'disease'=>$disease,
    'MaleMonth'=>$MaleMonth,'Malecount'=>$Malecount,'CountingMale'=>$CountingMale,'CountingFemale'=>$CountingFemale,'FemaleMonth'=>$FemaleMonth,
    'Femalecount'=>$Femalecount,'MalefarmerMonth'=>$MalefarmerMonth,'Malefarmercount'=>$Malefarmercount,'FemalefarmerMonth'=>$FemalefarmerMonth,
    'Femalefarmercount'=>$Femalefarmercount,'CountingMaleFarmers'=>$CountingMaleFarmers,'CountingFemaleFarmers'=>$CountingFemaleFarmers,
    'activeCount'=>$activeCount,'inactiveCount'=>$inactiveCount,'ActiveCoopMonth'=>$ActiveCoopMonth,'ActiveCoopCount'=>$ActiveCoopCount,
    'InactiveCoopMonth'=>$InactiveCoopMonth,'InactiveCoopCount'=>$InactiveCoopCount,'diseases'=>$diseases,'percentIncrease'=>$percentIncrease,
    'UserspercentIncrease'=>$UserspercentIncrease,'FarmerspercentIncrease'=>$FarmerspercentIncrease,'CooperativespercentIncrease'=>$CooperativespercentIncrease,
    'MaleUserspercentIncrease'=>$MaleUserspercentIncrease,'FemaleUserspercentIncrease'=>$FemaleUserspercentIncrease,'FemaleFarmerspercentIncrease'=>$FemaleFarmerspercentIncrease,
    'MaleFarmerspercentIncrease'=>$MaleFarmerspercentIncrease,'ActiveCooperativespercentIncrease'=>$ActiveCooperativespercentIncrease,'InactiveCooppercentIncrease'=>$InactiveCooppercentIncrease,
    'TotalReportedDiseases'=>$TotalReportedDiseases,'percentByDiseaseCategory'=>$percentByDiseaseCategory,
    'DiseaseCategoryPercentage'=>$DiseaseCategoryPercentage]);  
    }

    public function ManagerDashboard(){
      $userId=auth()->user()->id;
      $profileImg=User::find($userId);
      $currentMonth=date('m');
      $currentYear=date('Y');
      $previousMonth = $currentMonth - 1;
      $previousYear = $currentYear;
      if ($previousMonth == 0) {
        $previousMonth = 12;
        $previousYear -= 1;
    }
      $cooperative_id = DB::table('cooperative_user')
                   ->where('user_id', $userId)
                   ->value('cooperative_id');
        if ($cooperative_id) {
        $farmers = Farmer::where('cooperative_id', $cooperative_id)->get();
        $totalFarmers=$farmers->count();
        $total_trees = Farmer::where('cooperative_id', $cooperative_id)
                      ->sum('number_of_trees');
        $male_farmers=Farmer::where([['cooperative_id', '=', $cooperative_id],['gender', '=','Male'],])->count(); 
        $female_farmers=Farmer::where([['cooperative_id', '=', $cooperative_id],['gender', '=','Female'],])->count();             
        $diseases=Disease::count();
        $farmersCurrentMonthCount = DB::table('farmers')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count();
        $farmersPreviousMonthCount = DB::table('farmers')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();
     
        $maleFarmersCurrentMonthCount = DB::table('farmers')
                    ->where('gender','Male')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count();
        $maleFarmersPreviousMonthCount = DB::table('farmers')
                    ->where('gender','Male')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();
        $femaleFarmersCurrentMonthCount = DB::table('farmers')
                    ->where('gender','Female')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->count();
        $femaleFarmersPreviousMonthCount = DB::table('farmers')
                    ->where('gender','Female')
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->count();

                      if($femaleFarmersCurrentMonthCount==0){
                      $CoopFemaleFarmerspercentIncrease=0;
                      }else if($femaleFarmersPreviousMonthCount==0){
                      $CoopFemaleFarmerspercentIncrease=100;
                      }else{
                      $CoopFemaleFarmerspercentIncrease = ($femaleFarmersCurrentMonthCount - $femaleFarmersPreviousMonthCount) / $femaleFarmersPreviousMonthCount * 100;
                      }

                      if($maleFarmersCurrentMonthCount==0){
                      $CoopMaleFarmerspercentIncrease=0;
                      }else if($maleFarmersPreviousMonthCount==0){
                      $CoopMaleFarmerspercentIncrease=100;
                      }else{
                      $CoopMaleFarmerspercentIncrease = ($maleFarmersCurrentMonthCount - $maleFarmersPreviousMonthCount) / $maleFarmersPreviousMonthCount * 100;
                      }

                      if($farmersCurrentMonthCount==0){
                      $CoopFarmerspercentIncrease=0;
                      }else if($farmersPreviousMonthCount==0){
                      $CoopFarmerspercentIncrease=100;
                      }else{
                      $CoopFarmerspercentIncrease = ($farmersCurrentMonthCount - $farmersPreviousMonthCount) / $farmersPreviousMonthCount * 100;
                      }

                      

        // Get sum of sales for the current month
        $currentMonthSalesTotal = DB::table('sales')
                      ->where('cooperative_id',$cooperative_id)
                      ->whereMonth('created_at', Carbon::now()->month)
                      ->sum('price');

                      $CooperativeStockInventoryByCategory=DB::table('cooperative_stocks')
                      ->select('product_category', DB::raw('SUM(quantity) as total_quantity'))
                      ->where('cooperative_id', $cooperative_id)
                      ->groupBy('product_category')
                      ->get();

                      $currentYear = date('Y');
                      $previousYear = $currentYear - 1;
                      $currentMonth=date('m');
                      $previousMonth=$currentMonth-1;
                      if ($previousMonth == 0) {
                        $previousMonth = 12;
                    }

                      
                      $currentYearCount = DB::table('farmers')
                          ->where('cooperative_id',$cooperative_id)
                          ->whereYear('created_at', $currentYear)
                          ->count();
                      
                      $previousYearCount = DB::table('farmers')
                          ->where('cooperative_id',$cooperative_id)
                          ->whereYear('created_at', $previousYear)
                          ->count();
                      if($previousYearCount==0){
                        $increasedPercentage=100;
                      }else{
                        $increasedPercentage = ($currentYearCount - $previousYearCount) / $previousYearCount * 100;
                      }
                      
                      $farmerCounts = DB::table('farmers')
                      ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as ym, COUNT(*) as count'))
                      ->where('cooperative_id', $cooperative_id)
                      ->groupBy('ym')
                      ->get();
      

                      $treeCounts = DB::table('farmers')
                        ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as ym, SUM(number_of_trees) as total_trees'))
                        ->where('cooperative_id', $cooperative_id)
                        ->groupBy('ym')
                        ->get();
               
                      
                      
                      $treesCurrentYearCount= DB::table('farmers')
                      ->where('cooperative_id',$cooperative_id)
                      ->whereYear('created_at', $currentYear)
                      ->sum('number_of_trees');
                    

                      $treesPreviousYearCount= DB::table('farmers')
                      ->where('cooperative_id',$cooperative_id)
                      ->whereYear('created_at', $previousYear)
                      ->sum('number_of_trees');

                      if($treesPreviousYearCount == 0){
                        $increaseInTrees=100;
                      }else{
                        $increaseInTrees= ($treesCurrentYearCount - $treesPreviousYearCount) / $treesPreviousYearCount * 100;
                      }


                      $salesCurrentMonthCount=DB::table('sales')
                      ->where('cooperative_id',$cooperative_id)
                      ->whereMonth('created_at',$currentMonth)
                      ->sum('price');

                      $salesPreviousMonthCount=DB::table('sales')
                      ->where('cooperative_id',$cooperative_id)
                      ->whereMonth('created_at',$previousMonth)
                      ->sum('price');

                      if($salesPreviousMonthCount == 0){
                        $increaseInSales=100;
                      }else{
                        $increaseInSales=($salesCurrentMonthCount - $salesPreviousMonthCount) / $salesPreviousMonthCount * 100;
                      }

                      $sales = DB::table('sales')
                                ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as ym, SUM(price) as total_sales'))
                                ->where('cooperative_id', $cooperative_id)
                                ->groupBy('ym')
                                ->get();

                      $stocks = DB::table('stocks')          
                                ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as ym, SUM(quantity) as total_stocks'))
                                ->where('cooperative_id', $cooperative_id)
                                ->groupBy('ym')
                                ->get();

                      $stocksDates = DB::table('stocks')
                                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"))
                                ->distinct()
                                ->get();
                            
                      $salesDates = DB::table('sales')
                                ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"))
                                ->distinct()
                                ->get();
                            
                      $labels = $stocksDates->merge($salesDates)->unique('ym')->values();
                            

  return view('Manager/Dashboard',['totalFarmers'=>$totalFarmers,'total_trees'=>$total_trees,
  'diseases'=>$diseases,'profileImg'=>$profileImg,'male_farmers'=>$male_farmers,'female_farmers'=>$female_farmers,
  'CoopFarmerspercentIncrease'=>$CoopFarmerspercentIncrease,'CoopMaleFarmerspercentIncrease'=>$CoopMaleFarmerspercentIncrease,
  'CoopFemaleFarmerspercentIncrease'=>$CoopFemaleFarmerspercentIncrease,'currentMonthSalesTotal'=>$currentMonthSalesTotal,'stocks'=>$stocks,
  'CooperativeStockInventoryByCategory'=>$CooperativeStockInventoryByCategory,'increaseInSales'=>$increaseInSales,'sales'=>$sales,'labels'=>$labels,
  'increasedPercentage'=>$increasedPercentage,'increaseInTrees'=>$increaseInTrees,'farmerCounts'=>$farmerCounts,'treeCounts'=>$treeCounts]);
    }
  }

  public function CooperativeSales(){
    $user_id=Auth::User()->id;
    $profileImg=User::find($user_id);
    $i=0;                 
    
    $cooperative_id = DB::table('cooperative_user')
                   ->where('user_id', $user_id)
                   ->value('cooperative_id');

    $ArabicatotalRevenue = DB::table('sales')
                   ->where('cooperative_id', $cooperative_id)
                   ->where('product', 'Arabica beans')
                   ->sum('price');

    $RobustatotalRevenue = DB::table('sales')
                   ->where('cooperative_id', $cooperative_id)
                   ->where('product', 'Robusta beans')
                   ->sum('price');
                              
                   $currentMonth = Carbon::now()->month;
$previousMonth = $currentMonth - 1;
if ($previousMonth == 0) {
    $previousMonth = 12;
}

$revenueByCategory = DB::table('sales')
    ->select('product', 
             DB::raw('(SUM(CASE WHEN MONTH(created_at) = '.$currentMonth.' THEN price ELSE 0 END)) as current_month_revenue'),
             DB::raw('(SUM(CASE WHEN MONTH(created_at) = '.$previousMonth.' THEN price ELSE 0 END)) as previous_month_revenue'),
             DB::raw('(SUM(CASE WHEN MONTH(created_at) = '.$currentMonth.' THEN price ELSE 0 END) - SUM(CASE WHEN MONTH(created_at) = '.$previousMonth.' THEN price ELSE 0 END)) / SUM(CASE WHEN MONTH(created_at) = '.$previousMonth.' THEN price ELSE 0 END) * 100 as percentageIncrease')
            )
    ->where('cooperative_id', $cooperative_id)
    ->where(function ($query) use ($currentMonth) {
        $query->whereMonth('created_at', $currentMonth)
            ->orWhereMonth('created_at', $currentMonth - 1);
    })
    ->groupBy('product')
    ->get();
    

    $CooperativeSales=Sales::where('cooperative_id',$cooperative_id)->get();

    $SalesByPayment = DB::table('sales')
            ->select('payment', DB::raw('SUM(price) as total_amount'))
            ->where('cooperative_id',$cooperative_id)
            ->groupBy('payment')
            ->get();

    return view('Manager/Sales',['profileImg'=>$profileImg,'CooperativeSales'=>$CooperativeSales,
    'i'=>$i,'revenueByCategory'=>$revenueByCategory,'ArabicatotalRevenue'=>$ArabicatotalRevenue,
  'RobustatotalRevenue'=>$RobustatotalRevenue,'SalesByPayment'=>$SalesByPayment]);
  }

    public function UserRegistrationPage(){
      if(Auth::User()->can('create-user')){
      $userId =auth()->user()->id;
      $profileImg=User::find($userId);
      $roles=Role::all();
      $provinces=Province::all();
      return view('Register-new-user',['roles'=>$roles,'profileImg'=>$profileImg,'provinces'=>$provinces]);
      }
      
    }

    public function SystemUsers(){
      $no=0;
      $data=User::all();
      $userId =auth()->user()->id;
      $profileImg=User::find($userId);
      return view('All-system-users',['data'=>$data,'profileImg'=>$profileImg,'no'=>$no]);
    }

    public function Login(Request $request){
      $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);
  
    if (Auth::attempt($credentials)) {
      // Store the user's email address in the session
      Session::put('user', $credentials['email']);
      // Get the user's role
      $user_id = auth()->user()->id;
      $user_details = User::find($user_id);
      $user_role = $user_details->role;
      
      // Redirect the user based on their role
      if ($user_role === "Manager") {
        return redirect()->intended('Manager/Home');
      } elseif ($user_role === "SEDO" || $user_role === "Sector-agro" || $user_role === "District-agro" || $user_role === "Naeb" || $user_role === "Rab") {
        return redirect()->intended('Official/Home');
      }
      
        return redirect()->intended('Home');
  }
  
  
    return back()->withErrors([
      'email' => 'Credentials you provided are not correct.',
    ])->onlyInput('email');
  
    }

    public function logout(Request $request): RedirectResponse
{
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
}


    public function UserRegistration(Request $req){
        $user=new User;
        $destination_path ='public/images/users';
        $user->name=$req->name;
        $user->gender=$req->gender;
        $user->role=$req->role;
        $user->username=$req->username;
        $user->password=Hash::make($req->password);
        $user->email=$req->email;
        $user->phone=$req->phone;
        $user->province=Province::where('provincecode',$req->province)->value('provincename');
        $user->district=District::where('districtcode',$req->district)->value('namedistrict');
        $user->sector=Sector::where('sectorcode',$req->sector)->value('namesector');
        $user->cell=Cell::where('codecell',$req->cell)->value('nameCell');
        if($req->hasFile('image')){
          $image=$req->file('image');
        $image_name=$image->getClientOriginalName();
        $path = $req->file('image')->storeAs($destination_path,$image_name);
        $user->image=$image_name;
        }else{
          $user->image='userImage.jpg';
        }

        if($user->save()){
           $user->assignRole($req->input('role'));
        }
        
          return redirect('viewsystemuser');
        }

        public function UserProfilePage(){
          $userId = auth()->user()->id;
          $profileImg=User::find($userId);
          $userinfo=User::find($userId);
          if($userinfo->role==="Manager"){
            return view('Manager/Manager-profile',['userinfo'=>$userinfo,'userId'=>$userId,'profileImg'=>$profileImg]);
          }elseif($userinfo->role==="SEDO" || $userinfo->role==="Sector-agro" || $userinfo->role==="District-agro" || $userinfo->role==="Naeb" || $userinfo->role==="Rab"){
            return view('Official/Official-profile',['userinfo'=>$userinfo,'userId'=>$userId,'profileImg'=>$profileImg]);
          }else{
            return view('User-profile',['userinfo'=>$userinfo,'userId'=>$userId,'profileImg'=>$profileImg]);
          }
        }

        public function userProfileUpdate(Request $req,$id){
          $input=User::find($id);
          $input->username=$req->input('username');
          $input->email=$req->input('email');
          $input->phone=$req->input('phone');
          $current_password=$req->input('current_password');
          if(Hash::check($current_password, $input->password)){
              $input->update();
              $user_id=auth()->user()->id;
              $user_role=User::where('id',$user_id)->value('role');
              if($user_role==="Manager"){
                return redirect('Manager/Home');
              }elseif($user_role==="SEDO" || $user_role==="Sector-agro" || $user_role==="District-agro" || $user_role==="Naeb" || $user_role==="Rab"){
                return redirect('Official/Home');
              }
              else{
                return redirect('Home');
              }
        }else{
          return redirect('userProfile');
        }
      }

      public function profilePicUpdate(Request $req, $id)
{
    $input = User::find($id);
    $destination_path = 'public/images/users';
    $old_image = $input->image;
    $image = $req->file('image');
    if ($image) {
        // Delete old image if it exists
        if (Storage::disk('local')->exists($old_image)) {
            Storage::disk('local')->delete($old_image);
        }
        $image_name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $input->image = $image_name;
        $path = $req->file('image')->storeAs($destination_path, $image_name);
    } else {
        $input->image = $old_image;
    }
    $input->update();

    // Delete old image from directory if it was replaced by the new image
    if ($image && Storage::disk('local')->exists($destination_path . '/' . $old_image)) {
        Storage::disk('local')->delete($destination_path . '/' . $old_image);
    }

    return redirect('userProfile');
}

      

        public function userPasswordUpdate(Request $req,$id){
          $input=User::find($id);
          $user_password=$req->input('current_password');
          $new_password=$req->input('new_password');
          $confirm_password=$req->input('confirm_new_password');
          if($new_password===$confirm_password && (Hash::check($user_password, $input->password)) ){
          $input->password=Hash::make($new_password);
          $input->save();
          $user_id=auth()->user()->id;
          $user_role=User::where('id',$user_id)->value('role');
          if($user_role==="Manager"){
            return redirect('Manager/Home');
          }elseif($user_role==="SEDO" || $user_role==="Sector-agro" || $user_role==="District-agro" || $user_role==="Naeb" || $user_role==="Rab"){
            return redirect('Official/Home');
          }
          else{
            return redirect('Home');
          }

          }
          return redirect('userProfile');
        }

        public function deleteuser($id){
          User::find($id)->delete();
          return redirect('viewsystemuser');
        }

        public function userdetails($id){
          $details=User::find($id);
          $userId =auth()->user()->id;
          $profileImg=User::find($userId);
          return view('User-details',['details'=>$details,'profileImg'=>$profileImg]);
        }

        public function updateSystemUser(Request $req,$id){
          $input=User::find($id);
          $input->name=$req->input('name');
          $input->gender=$req->input('gender');
          $input->role=$req->input('role');
          $input->username=$req->input('username');
          $input->email=$req->input('email');
          $input->phone=$req->input('phone');
          $input->province=Province::where('provincecode',$req->input('province'))->value('provincename');
          $input->district=District::where('districtcode',$req->input('district'))->value('namedistrict');
          $input->sector=Sector::where('sectorcode',$req->input('sector'))->value('namesector');
          $input->cell=Cell::where('codecell',$req->input('cell'))->value('nameCell');
          if($input->update()){
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $input->assignRole($input->role);
          };
          return redirect('viewsystemuser');
        }

        public function profileupdatepage($id){
          $fulldetails=User::find($id);
          $roles=Role::all();
          $userId =auth()->user()->id;
          $profileImg=User::find($userId);
          $provinces=Province::all();
          return view('Update-details',['fulldetails'=>$fulldetails,'roles'=>$roles,'profileImg'=>$profileImg,
        'provinces'=>$provinces]);
        }

        public function analytics(){
          $user_id=Auth::user()->id;
          $profileImg=User::find($user_id);
          $Coopdata=Cooperative::select('id','created_at')->get()->groupBy(function($Coopdata){
            return Carbon::parse($Coopdata->created_at)->format('Y-M');
          });
          $months=[];
          $monthCount=[];
          foreach($Coopdata as $coopmonth => $values){
            $months[]=$coopmonth;
            $monthCount[]=count($values);
          }
          $Memdata=Farmer::select('id','created_at')->get()->groupBy(function($Memdata){
            return Carbon::parse($Memdata->created_at)->format('Y-M');
          });
          $Memmonths=[];
          $MemMonthCount=[];
          foreach($Memdata as $memmonth => $values){
            $Memmonths[]=$memmonth;
            $MemMonthCount[]=count($values);
          }
          $Userdata=User::select('id','created_at')->get()->groupBy(function($Userdata){
            return Carbon::parse($Userdata->created_at)->format('Y-M');
          });
          $Usermonths=[];
          $UserMonthCount=[];
          foreach($Userdata as $usermonth => $values){
            $Usermonths[]=$usermonth;
            $UserMonthCount[]=count($values);
          }
          $Diseasedata=Disease::select('id','created_at')->get()->groupBy(function($Diseasedata){
            return Carbon::parse($Diseasedata->created_at)->format('Y-M');
          });
          $Diseasemonths=[];
          $DiseaseMonthCount=[];
          foreach($Diseasedata as $dismonth => $values){
            $Diseasemonths[]=$dismonth;
            $DiseaseMonthCount[]=count($values);
          }
          return view('Analytics',['profileImg'=>$profileImg,'months'=>$months,'monthCount'=>$monthCount,
        'Memmonths'=>$Memmonths,'MemMonthCount'=>$MemMonthCount,'Usermonths'=>$Usermonths,
        'UserMonthCount'=>$UserMonthCount,'Diseasemonths'=>$Diseasemonths,'DiseaseMonthCount'=>$DiseaseMonthCount]);
        }

        public function DeleteDisease($id){
            Disease::find($id)->delete();
            return redirect()->back();
        }

}
