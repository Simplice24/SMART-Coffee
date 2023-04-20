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
        
                $districts = [
                    ['name' => 'Kigali City', 'latitude' => -1.9441, 'longitude' => 30.0619],
                    ['name' => 'Gasabo', 'latitude' => -1.9516, 'longitude' => 30.1166],
                    ['name' => 'Kicukiro', 'latitude' => -1.9439, 'longitude' => 30.1412],
                    ['name' => 'Nyarugenge', 'latitude' => -1.9534, 'longitude' => 30.0594],
                    ['name' => 'Burera', 'latitude' => -1.4671, 'longitude' => 29.8116],
                    ['name' => 'Gakenke', 'latitude' => -1.7865, 'longitude' => 29.7757],
                    ['name' => 'Gicumbi', 'latitude' => -1.6784, 'longitude' => 29.7077],
                    ['name' => 'Musanze', 'latitude' => -1.4793, 'longitude' => 29.5835],
                    ['name' => 'Rulindo', 'latitude' => -1.5553, 'longitude' => 29.7955],
                    ['name' => 'Nyabihu', 'latitude' => -1.5231, 'longitude' => 29.4035],
                    ['name' => 'Nyamasheke', 'latitude' => -2.4376, 'longitude' => 29.1608],
                    ['name' => 'Rubavu', 'latitude' => -1.7038, 'longitude' => 29.6327],
                    ['name' => 'Rusizi', 'latitude' => -2.4439, 'longitude' => 28.8947],
                    ['name' => 'Nyamagabe', 'latitude' => -2.6001, 'longitude' => 29.3729],
                    ['name' => 'Nyanza', 'latitude' => -2.3526, 'longitude' => 29.7402],
                    ['name' => 'Huye', 'latitude' => -2.5085, 'longitude' => 29.6415],
                    ['name' => 'Gisagara', 'latitude' => -2.5299, 'longitude' => 29.7695],
                    ['name' => 'Kamonyi', 'latitude' => -2.2391, 'longitude' => 29.8109],
                    ['name' => 'Muhanga', 'latitude' => -2.1663, 'longitude' => 29.7362],
                    ['name' => 'Ngororero', 'latitude' => -2.5158, 'longitude' => 29.2934],
                    ['name' => 'Karongi', 'latitude' => -2.0956, 'longitude' => 29.3606],
                    ['name' => 'Rutsiro', 'latitude' => -2.0778, 'longitude' => 29.1937],
                    ['name' => 'Ruhango', 'latitude' => -2.1116, 'longitude' => 29.6311],
                    ['name' => 'Kayonza', 'latitude' => -1.8672, 'longitude' => 30.4289],
                    ['name' => 'Kirehe', 'latitude' => -2.1315, 'longitude' => 30.4015],
                ];
                        

        return view('All-diseases',['profileImg'=>$profileImg,'disease'=>$disease,'no'=>$no,'districts'=>$districts,
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
