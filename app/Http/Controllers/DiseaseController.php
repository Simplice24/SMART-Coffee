<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Disease;

class DiseaseController extends Controller
{
    public function SystemDiseases(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $disease=Disease::paginate(7);
        return view('All-diseases',['profileImg'=>$profileImg,'disease'=>$disease]);
    }

    public function DiseaseRegistrationPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('Register-disease',['profileImg'=>$profileImg]);
    }

    public function CooperativeDiseases(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $disease=Disease::paginate(7);
        return view('Manager/Diseases',['profileImg'=>$profileImg,'disease'=>$disease]);
    }

    public function DiseaseRegistration(Request $req){
        $Disease=new Disease;
        $destination_path ='public/images/diseases';
        $Disease->disease_name=$req->disease;
        $Disease->category=$req->category;
        $Disease->description=$req->description;
        $image=$req->file('image');
        $image_name=$image->getClientOriginalName();
        $path = $req->file('image')->storeAs($destination_path,$image_name);
        $Disease->image=$image_name;
        $Disease->save();            
        return redirect('viewdiseases');
    }
}
