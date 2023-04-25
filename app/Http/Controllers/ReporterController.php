<?php

namespace App\Http\Controllers;
use App\Models\Reporter;
use App\Models\Farmer;
use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ReporterController extends Controller
{
    public function ReportPrevilegePage($id){
        $farmer=$id;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('Manager/Previlege',['farmer'=>$farmer,'profileImg'=>$profileImg]);
    }

    public function GrantPrevilege(Request $req){
        $reporter=new Reporter();
        $reporter->farmer_id=$req->farmer_id;
        $reporter->username=$req->username;
        $reporter->email=$req->email;
        $password=$req->password;
        $password_confirmation=$req->confirm_password;
        if($password===$password_confirmation){
            $reporter->password=Hash::make($req->password);
            $reporter->save();
            return redirect('CooperativeFarmers')->with('success','Reporting previlege is granted to the farmer');
        }
        else{
            return redirect()->back()->with('error', 'Passwords do not match');
        }
    }
}
