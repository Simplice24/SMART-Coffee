<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Disease;

class DiseaseController extends Controller
{
    public function SystemDiseases(){
        $no=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $disease=Disease::paginate(7);
        return view('All-diseases',['profileImg'=>$profileImg,'disease'=>$disease,'no'=>$no]);
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

    public function DiseaseDetailsPage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $diseaseinfo=Disease::find($id);
        return view('Disease-details',['diseaseinfo'=>$diseaseinfo,'profileImg'=>$profileImg]);
    }

    public function DiseaseUpdatePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);    
        $diseaseinfo=Disease::find($id);
        return view('Disease-update',['diseaseinfo'=> $diseaseinfo,'profileImg'=>$profileImg]);
    }
    
    public function DiseaseUpdate(Request $req,$id){
        $destination_path = 'public/images/diseases';
        $input = Disease::find($id);
        $default_name = $input->image;
        $input->disease_name = $req->input('disease_name');
        $input->category = $req->input('category');
        $input->description = $req->input('description');
        $image = $req->file('image');
        if ($image) {
            $image_name = $image->getClientOriginalName();
            $path = $req->file('image')->storeAs($destination_path, $image_name);
        } else {
            $image_name = $default_name;
            $path = null; // Set path to null since no file was uploaded
        }
        $input->image = $image_name;
        $input->update();

        return redirect('viewdiseases');
      }

      public function DeleteDisease($id){
        Disease::find($id)->delete();
        return redirect('viewdiseases');
      }

      public function CooperativeDiseaseDetails($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $diseaseinfo=Disease::find($id);
        return view('Manager/Disease-details',['diseaseinfo'=>$diseaseinfo,'profileImg'=>$profileImg]);
      }

      public function ReportingDisease($id){
        
      }


}
