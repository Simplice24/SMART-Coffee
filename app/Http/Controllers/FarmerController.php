<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cooperative;
use App\Models\Farmer;

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
          $cooperative = App\Cooperative::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->first();
        if ($cooperative) {
        $cooperative_id = $cooperative->id;
        $farmers = Farmer::where('cooperative_id', $cooperative_id)->get();
        return view('Cooperative-farmers',['farmers'=>$farmers,'no'=>$no,'profileImg'=>$profileImg]);
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
}
