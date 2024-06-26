<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cooperative;
use App\Models\Farmer;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;
use App\Models\Cell;
use Illuminate\Support\Facades\DB;


class FarmerController extends Controller
{
    public function SystemFarmers(){
        $no=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $info=Farmer::all();
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
        $farmers = Farmer::where('cooperative_id', $cooperative_id)->get();
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

    public function FarmerRegistrationPage_Manager(){
      $userId =auth()->user()->id;
      $profileImg=User::find($userId);
      return view('Manager/Register-Farmer',['profileImg'=>$profileImg]);
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
        $input->province=Province::where('provincecode',$req->input('province'))->value('provincename');
        $input->district=District::where('districtcode',$req->input('district'))->value('namedistrict');
        $input->sector=Sector::where('sectorcode',$req->input('sector'))->value('namesector');
        $input->cell=Cell::where('codecell',$req->input('cell'))->value('nameCell');
        $input->save();return redirect('viewfarmers');
      }

      public function ManagerFarmerRegistration(Request $req){
        $User_id=auth()->user()->id;
        $cooperative_id=DB::table('cooperative_user')
                        ->where('user_id',$User_id)
                        ->value('cooperative_id');
        $cooperative_name=DB::table('cooperatives')
                          ->where('id',$cooperative_id)
                          ->value('name');                                 
        $input=new Farmer;
        $input->name=$req->input('name');
        $input->idn=$req->input('idn');
        $input->cooperative_name=$cooperative_name;
        $input->cooperative_id=$cooperative_id;
        $input->gender=$req->input('gender');
        $input->number_of_trees=$req->input('number_of_trees');
        $input->fertilizer=$req->input('fertilizer');
        $input->phone=$req->input('phone');
        $input->province=Province::where('provincecode',$req->input('province'))->value('provincename');
        $input->district=District::where('districtcode',$req->input('district'))->value('namedistrict');
        $input->sector=Sector::where('sectorcode',$req->input('sector'))->value('namesector');
        $input->cell=Cell::where('codecell',$req->input('cell'))->value('nameCell');
        $input->save();
        return redirect('CooperativeFarmers');
      }

      public function FarmerProfilePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $farmerinfo=Farmer::find($id);
        return view('Farmer-details',['farmerinfo'=>$farmerinfo,'profileImg'=>$profileImg]);
      }

      public function CooperativeFarmerprofile($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $farmerinfo=Farmer::find($id);
        return view('Manager/Cooperative-farmer-details',['farmerinfo'=>$farmerinfo,'profileImg'=>$profileImg]);
      }

      public function FarmerUpdatePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $farmerinfo=Farmer::find($id);
        $provinces=Province::all();
        return view('Farmer-update',['farmerinfo'=>$farmerinfo,'profileImg'=>$profileImg,'provinces'=>$provinces]);
      }

      public function CooperativeFarmerUpdatePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $farmerinfo=Farmer::find($id);
        $provinces=Province::all();
        return view('Manager/Cooperative-farmer-update',['farmerinfo'=>$farmerinfo,'profileImg'=>$profileImg,'provinces'=>$provinces]);
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
        $farmerupdate->province=Province::where('provincecode',$req->input('province'))->value('provincename');
        $farmerupdate->district=District::where('districtcode',$req->input('district'))->value('namedistrict');
        $farmerupdate->sector=Sector::where('sectorcode',$req->input('sector'))->value('namesector');
        $farmerupdate->cell=Cell::where('codecell',$req->input('cell'))->value('nameCell');
        $farmerupdate->update();
        return redirect('viewfarmers');
      }

      public function CooperativeFarmerUpdate(Request $req,$id){
        $User_id=auth()->user()->id;
        $cooperative_id=DB::table('cooperative_user')
                        ->where('user_id',$User_id)
                        ->value('cooperative_id');
        $cooperative_name=DB::table('cooperatives')
                          ->where('id',$cooperative_id)
                          ->value('name');                                 
        $farmerupdate=Farmer::find($id);
        $farmerupdate->name=$req->input('name');
        $farmerupdate->idn=$req->input('idn');
        $farmerupdate->cooperative_name=$cooperative_name;
        $farmerupdate->cooperative_id=$cooperative_id;
        $farmerupdate->gender=$req->input('gender');
        $farmerupdate->number_of_trees=$req->input('number_of_trees');
        $farmerupdate->fertilizer=$req->input('fertilizer');
        $farmerupdate->phone=$req->input('phone');
        $farmerupdate->province=Province::where('provincecode',$req->input('province'))->value('provincename');
        $farmerupdate->district=District::where('districtcode',$req->input('district'))->value('namedistrict');
        $farmerupdate->sector=Sector::where('sectorcode',$req->input('sector'))->value('namesector');
        $farmerupdate->cell=Cell::where('codecell',$req->input('cell'))->value('nameCell');
        $farmerupdate->update();

        return redirect('CooperativeFarmers');
      }

      public function DeleteFarmer($id){
        Farmer::find($id)->delete();
        return redirect('viewfarmers');
      }

      public function DeleteCooperativeFarmer($id){
        Farmer::find($id)->delete();
        return redirect('CooperativeFarmers');
      }
}
