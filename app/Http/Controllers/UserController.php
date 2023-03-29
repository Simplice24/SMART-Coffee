<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use App\Models\Disease;
use App\Models\Cooperative;
use App\Models\Province;
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
      return view('Dashboard',['profileImg'=>$profileImg,'rows'=>$rows,'farmer'=>$farmer,'cooperative'=>$cooperative,'disease'=>$disease]);  
    }

    public function ManagerDashboard(){
      $userId=auth()->user()->id;
      $profileImg=User::find($userId);
      $cooperative_id = DB::table('cooperative_user')
                   ->where('user_id', $userId)
                   ->value('cooperative_id');
        if ($cooperative_id) {
        $farmers = Farmer::where('cooperative_id', $cooperative_id)->get();
        $totalFarmers=$farmers->count();
        $diseases=Disease::count();
        return view('Manager/Dashboard',['totalFarmers'=>$totalFarmers,'diseases'=>$diseases,'profileImg'=>$profileImg]);
    }
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
          return view('User-profile',['userinfo'=>$userinfo,'userId'=>$userId,'profileImg'=>$profileImg]);
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
