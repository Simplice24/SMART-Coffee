<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Disease;
use App\Models\ReportedDisease;
use Illuminate\Support\Facades\DB;

class DiseaseController extends Controller
{
    public function SystemDiseases(){
        $no=0;
        $noo=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $disease=Disease::all();
        $reported_diseases=ReportedDisease::all();
        $currentMonth = date('m');
        $currentYear=date('Y');
        $monthlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('MONTH(reported_diseases.created_at) as month'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereRaw('MONTH(reported_diseases.created_at) = ?', [$currentMonth])
                ->groupBy('month', 'diseases.disease_name')
                ->get();
        $yearlyCounts = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw('YEAR(reported_diseases.created_at) as year'), 'diseases.disease_name', DB::raw('COUNT(*) as count'))
                ->whereRaw('YEAR(reported_diseases.created_at) = ?', [$currentYear])
                ->groupBy('year', 'diseases.disease_name')
                ->get();
        return view('All-diseases',['profileImg'=>$profileImg,'disease'=>$disease,'no'=>$no,
        'reported_diseases'=>$reported_diseases,'noo'=>$noo,'monthlyCounts'=>$monthlyCounts,'yearlyCounts'=>$yearlyCounts]);
    }

    public function DiseaseRegistrationPage(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        return view('Register-disease',['profileImg'=>$profileImg]);
    }
    

    public function CooperativeDiseases(){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $disease=Disease::all();
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
        $Manager_id=auth()->user()->id;
        $cooperative_id=DB::table('cooperative_user')
                        ->where('user_id',$Manager_id)
                        ->value('cooperative_id');
        $reported_disease=new ReportedDisease();
        $reported_disease->cooperative_id=$cooperative_id;
        $reported_disease->disease_id=$id;
        $reported_disease->disease_category=Disease::where('id',$id)->value('category');
        if($reported_disease->save()){
            return redirect()->back()->with('success', 'Disease reported successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong, disease not reported');
        }
      }

      public function deleteReportedDisease($id){
        ReportedDisease::where('disease_id',$id)->delete();
        return redirect('viewdiseases');
      }


}
