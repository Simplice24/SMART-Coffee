<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use App\Models\Disease;
use App\Models\Cooperative;
use App\Models\Province;
use App\Models\Sales;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

      return view('Dashboard',['profileImg'=>$profileImg,'rows'=>$rows,'farmer'=>$farmer,'cooperative'=>$cooperative,'disease'=>$disease,
    'MaleMonth'=>$MaleMonth,'Malecount'=>$Malecount,'CountingMale'=>$CountingMale,'CountingFemale'=>$CountingFemale,'FemaleMonth'=>$FemaleMonth,
    'Femalecount'=>$Femalecount,'MalefarmerMonth'=>$MalefarmerMonth,'Malefarmercount'=>$Malefarmercount,'FemalefarmerMonth'=>$FemalefarmerMonth,
    'Femalefarmercount'=>$Femalefarmercount,'CountingMaleFarmers'=>$CountingMaleFarmers,'CountingFemaleFarmers'=>$CountingFemaleFarmers,
    'activeCount'=>$activeCount,'inactiveCount'=>$inactiveCount,'ActiveCoopMonth'=>$ActiveCoopMonth,'ActiveCoopCount'=>$ActiveCoopCount,
    'InactiveCoopMonth'=>$InactiveCoopMonth,'InactiveCoopCount'=>$InactiveCoopCount,'diseases'=>$diseases,'percentIncrease'=>$percentIncrease,
  'UserspercentIncrease'=>$UserspercentIncrease,'FarmerspercentIncrease'=>$FarmerspercentIncrease,'CooperativespercentIncrease'=>$CooperativespercentIncrease,
'MaleUserspercentIncrease'=>$MaleUserspercentIncrease,'FemaleUserspercentIncrease'=>$FemaleUserspercentIncrease,'FemaleFarmerspercentIncrease'=>$FemaleFarmerspercentIncrease,
'MaleFarmerspercentIncrease'=>$MaleFarmerspercentIncrease,'ActiveCooperativespercentIncrease'=>$ActiveCooperativespercentIncrease,'InactiveCooppercentIncrease'=>$InactiveCooppercentIncrease]);  
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
        $treesCurrentMonthCount = DB::table('farmers')
                    ->where('cooperative_id',$cooperative_id)
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->sum('number_of_trees');
        $treesPreviousMonthCount = DB::table('farmers')
                    ->where('cooperative_id',$cooperative_id)
                    ->whereMonth('created_at', $previousMonth)
                    ->whereYear('created_at', $previousYear)
                    ->sum('number_of_trees');
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
                      if($treesCurrentMonthCount==0){
                        $treespercentIncrease=0;
                        }else if($treesPreviousMonthCount==0){
                        $treespercentIncrease=100;
                        }else{
                        $treespercentIncrease = ($treesCurrentMonthCount - $treesPreviousMonthCount) / $treesPreviousMonthCount * 100;
                        }
        return view('Manager/Dashboard',['totalFarmers'=>$totalFarmers,'total_trees'=>$total_trees,
        'diseases'=>$diseases,'profileImg'=>$profileImg,'male_farmers'=>$male_farmers,'female_farmers'=>$female_farmers,
      'CoopFarmerspercentIncrease'=>$CoopFarmerspercentIncrease,'CoopMaleFarmerspercentIncrease'=>$CoopMaleFarmerspercentIncrease,
    'CoopFemaleFarmerspercentIncrease'=>$CoopFemaleFarmerspercentIncrease,'treespercentIncrease'=>$treespercentIncrease]);
    }
  }

  public function CooperativeSales(){
    $user_id=Auth::User()->id;
    $profileImg=User::find($user_id);
    $i=0;
    
    $cooperative_id = DB::table('cooperative_user')
                   ->where('user_id', $user_id)
                   ->value('cooperative_id');
    $CooperativeSales=Sales::where('cooperative_id',$cooperative_id)->get();
    return view('Manager/Sales',['profileImg'=>$profileImg,'CooperativeSales'=>$CooperativeSales,
    'i'=>$i,]);
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
      $data=User::paginate(5);
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
      $request->session()->put('user',$credentials['email']);
      $user_id=auth()->user()->id;
      $user_details=User::find($user_id);
      $user_role=$user_details->role;
      if($user_role==="Manager"){
      return redirect()->intended('Manager/Home');
      }
      return redirect()->intended('Home');
    }
  
    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
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
        $user->province=$req->province;
        $user->district=$req->district;
        $user->sector=$req->sector;
        $user->cell=$req->cell;
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
              }else{
                return redirect('userProfile');
                   }
                  
          return redirect('Home');
        }

        public function profilePicUpdate(Request $req,$id){
          $input=User::find($id);
          $destination_path ='public/images/users';
          $image=$req->file('image');
          $image_name=$image->getClientOriginalName();
          $path = $req->file('image')->storeAs($destination_path,$image_name);
          $input->image=$image_name;
          $input->save();
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
          return redirect('Home');
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
          $input->province=$req->input('province');
          $input->district=$req->input('district');
          $input->sector=$req->input('sector');
          $input->cell=$req->input('cell');
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
          return view('Update-details',['fulldetails'=>$fulldetails,'roles'=>$roles,'profileImg'=>$profileImg]);
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

}
