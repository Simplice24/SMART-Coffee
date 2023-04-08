<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Sales;
use App\Models\Stock;
use App\Models\Cooperative;
use Illuminate\Support\Facades\DB;

class CooperativeController extends Controller
{
    public function SystemCooperatives(){
        $no=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $data=Cooperative::paginate(7);
        return view('All-cooperatives',['profileImg'=>$profileImg,'data'=>$data,'no'=>$no]);
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

    public function CooperativeViewPage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $cooperativeinfo=Cooperative::find($id);
        return view('Cooperative-details',['cooperativeinfo'=>$cooperativeinfo,'profileImg'=>$profileImg]);
    }

    public function Cooperativeupdatepage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $cooperativeinfo=Cooperative::find($id);
        $manager_names=User::all()->where('role','Manager');
        return view('Cooperative-update',['cooperativeinfo'=> $cooperativeinfo,'manager_names'=>$manager_names,'profileImg'=>$profileImg]);
      }

      public function UpdateSystemCooperative(Request $req,$id){
        $user_id = DB::table('cooperative_user')
                ->where('cooperative_id', $id)
                ->value('user_id');
        $manager_id=$req->manager_name;
        $manager_details = User::find($manager_id);
        $manager_name= $manager_details->name;
        $input=Cooperative::find($id);
        $input->name=$req->input('name');
        $input->manager_name=$manager_name;
        $input->email=$req->input('email');
        $input->status=$req->input('status');
        $input->starting_date=$req->input('starting_date');
        $input->province=$req->input('province');
        $input->district=$req->input('district');
        $input->sector=$req->input('sector');
        $input->cell=$req->input('cell');
        $input->update();
        $input->users()->detach($user_id);
        $input->users()->attach($manager_id);
        return redirect('viewcooperatives');
      }  

      public function DeleteCooperative($id){
        Cooperative::destroy($id);
        return redirect('viewcooperatives');
      }

      public function updateCooperativeSales($id){
        $user_id =auth()->user()->id;
        $profileImg=User::find($user_id);
        $Salesdetails=Sales::find($id);
        return view('Manager/Sales-update',['Salesdetails'=>$Salesdetails,'profileImg'=>$profileImg]);
      }

      public function updateCooperativeStock($id){
        $user_id =auth()->user()->id;
        $profileImg=User::find($user_id);
        $Stockdetails=Stock::find($id);
        return view('Manager/Stock-update',['Stockdetails'=>$Stockdetails,'profileImg'=>$profileImg]);
      }
        
}
