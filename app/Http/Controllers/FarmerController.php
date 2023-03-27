<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cooperative;
use App\Models\Farmer;
use Illuminate\Support\Facades\DB;

class FarmerController extends Controller
{
    public function SystemFarmers(){
        $no=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $info=Farmer::paginate(7);
        return view('All-farmers',['profileImg'=>$profileImg,'info'=>$info,'no'=>$no]);
    }

    public function CooperativeFarmers(){
        $no=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        if($profileImg->role==="Manager"){
          $cooperative_id = DB::table('cooperative_user')
                   ->where('user_id', $userId)
                   ->value('cooperative_id');
        if ($cooperative_id) {
        $farmers = Farmer::where('cooperative_id', $cooperative_id)->paginate(7);
        return view('Manager/Cooperative-farmers',['farmers'=>$farmers,'no'=>$no,'profileImg'=>$profileImg]);
        }
        }
    }

    public function FarmerRegistrationPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $cooperatives=Cooperative::all();
        return view('Register-farmer',['profileImg'=>$profileImg,'cooperatives'=>$cooperatives]);
    }

    public function FarmerRegistration(Request $req){
        $input=new Farmer;
        $input->name=$req->input('name');
        $input->idn=$req->input('idn');
        $input->cooperative_name=$req->input('cooperative_name');
        $input->cooperative_id=$req->input('cooperative_id');
        $input->gender=$req->input('gender');
        $input->number_of_trees=$req->input('number_of_trees');
        $input->fertilizer=$req->input('fertilizer');
        $input->phone=$req->input('phone');
        $input->province=$req->input('province');
        $input->district=$req->input('district');
        $input->sector=$req->input('sector');
        $input->cell=$req->input('cell');
        $input->save();
        return redirect('viewfarmers');
      }

      public function FarmerProfilePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $farmerinfo=Farmer::find($id);
        return view('Farmer-details',['farmerinfo'=>$farmerinfo,'profileImg'=>$profileImg]);
      }

      public function FarmerUpdatePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $farmerinfo=Farmer::find($id);
        return view('Farmer-update',['farmerinfo'=>$farmerinfo,'profileImg'=>$profileImg]);
      }

      public function UpdateFarmer(Request $req,$id){
        $farmerupdate=Farmer::find($id);
        $farmerupdate->name=$req->input('name');
        $farmerupdate->idn=$req->input('idn');
        $farmerupdate->cooperative_name=$req->input('cooperative_name');
        $farmerupdate->cooperative_id=$req->input('cooperative_id');
        $farmerupdate->gender=$req->input('gender');
        $farmerupdate->number_of_trees=$req->input('number_of_trees');
        $farmerupdate->fertilizer=$req->input('fertilizer');
        $farmerupdate->phone=$req->input('phone');
        $farmerupdate->province=$req->input('province');
        $farmerupdate->district=$req->input('district');
        $farmerupdate->sector=$req->input('sector');
        $farmerupdate->cell=$req->input('cell');
        $farmerupdate->update();
        return redirect('viewfarmers');
      }

      public function DeleteFarmer($id){
        Farmer::find($id)->delete();
        return redirect('viewfarmers');
      }
}
