<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cooperative;

class CooperativeController extends Controller
{
    public function SystemCooperatives(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $data=Cooperative::paginate(7);
        return view('All-cooperatives',['profileImg'=>$profileImg,'data'=>$data]);
    }

    public function CooperativeRegistrationPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $manager_names=User::all()->where('role', 'Manager');
        return view('Register-cooperative',['profileImg'=>$profileImg,'manager_names'=>$manager_names]);
    }

    public function CooperativeRegistration(Request $req){
        $manager_id=$req->manager_name;
        $manager_details = User::find($manager_id);
        $manager_name= $manager_details->name;
        $cooperative=new Cooperative;
        $cooperative->name=$req->name;
        $cooperative->manager_name=$manager_name;
        $cooperative->category=$req->category;
        $cooperative->email=$req->email;
        $cooperative->status=$req->status;
        $cooperative->starting_date=$req->starting_date;
        $cooperative->province=$req->province;
        $cooperative->district=$req->district;
        $cooperative->sector=$req->sector;
        $cooperative->cell=$req->cell;
        $cooperative->save();
        $cooperative->users()->attach($manager_id);
        return redirect('viewcooperatives');
    }
}
