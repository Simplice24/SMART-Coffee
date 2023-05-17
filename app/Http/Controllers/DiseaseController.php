<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Disease;
use App\Models\ReportedDisease;
use Illuminate\Support\Facades\DB;
use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Storage;


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
        $YearMonth=date('Y-m');
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

        $diseases = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select('reported_diseases.*', 'diseases.disease_name', 'diseases.id', DB::raw('COUNT(reported_diseases.disease_id) as disease_count'))
                ->groupBy('reported_diseases.id', 'reported_diseases.cooperative_id', 'reported_diseases.disease_id','reported_diseases.disease_category','reported_diseases.longitude','reported_diseases.latitude', 'diseases.id','diseases.disease_name','reported_diseases.created_at','reported_diseases.updated_at')
                ->get();

       

        $districts = [
                    ['name' => 'Gasabo', 'latitude' => -1.9543, 'longitude' => 30.1358],
                    ['name' => 'Kicukiro', 'latitude' => -1.9906, 'longitude' => 30.1256],
                    ['name' => 'Nyarugenge', 'latitude' => -1.9544, 'longitude' => 30.0604],

                    ['name' => 'Nyanza', 'latitude' => -2.3418 , 'longitude' => 29.7381],
                    ['name' => 'Huye', 'latitude' => -2.5061, 'longitude' => 29.6919],
                    ['name' => 'Gisagara', 'latitude' => -2.4874, 'longitude' => 29.5266],
                    ['name' => 'Kamonyi', 'latitude' => -2.0618, 'longitude' =>  29.8649],
                    ['name' => 'Muhanga', 'latitude' => -2.0061, 'longitude' => 29.7386],
                    ['name' => 'Ruhango', 'latitude' => -2.1459, 'longitude' => 29.7753],
                    ['name' => 'Nyamagabe', 'latitude' => -2.4687, 'longitude' => 29.5837],
                    ['name' => 'Nyaruguru', 'latitude' => -2.5853, 'longitude' => 29.5735],

                    ['name' => 'Karongi', 'latitude' => -2.1543, 'longitude' => 29.3688],
                    ['name' => 'Ngororero', 'latitude' => -2.5022, 'longitude' => 29.5645],
                    ['name' => 'Nyabihu', 'latitude' => -1.6705, 'longitude' => 29.3594],
                    ['name' => 'Nyamasheke', 'latitude' => -2.3356, 'longitude' => 29.1196],
                    ['name' => 'Rubavu', 'latitude' => -1.5074, 'longitude' => 29.6309],
                    ['name' => 'Rusizi', 'latitude' => -2.4702, 'longitude' => 28.9092],
                    ['name' => 'Rutsiro', 'latitude' => -2.0736, 'longitude' => 29.1937],

                    ['name' => 'Burera', 'latitude' => -1.5986, 'longitude' => 29.6316],
                    ['name' => 'Gakenke', 'latitude' => -1.7326, 'longitude' => 29.8046],
                    ['name' => 'Gicumbi', 'latitude' => -1.6850, 'longitude' => 30.0642],
                    ['name' => 'Musanze', 'latitude' => -1.5014, 'longitude' =>  29.6317],
                    ['name' => 'Rulindo', 'latitude' => -1.6361, 'longitude' => 30.1165],
                          
                    ['name' => 'Bugesera', 'latitude' => -2.1841, 'longitude' => 30.0512],
                    ['name' => 'Gatsibo', 'latitude' => -1.6756, 'longitude' => 30.4091],
                    ['name' => 'Kayonza', 'latitude' => -1.8623, 'longitude' => 30.5663],
                    ['name' => 'Kirehe', 'latitude' => -2.1581, 'longitude' => 30.5424],
                    ['name' => 'Ngoma', 'latitude' => -2.1965, 'longitude' => 30.5285],
                    ['name' => 'Nyagatare', 'latitude' => -1.3121, 'longitude' => 30.4212],
                    ['name' => 'Rwamagana', 'latitude' => -1.9514, 'longitude' => 30.4384],
                ];



        $DiseaseReported = DB::table('reported_diseases')
                ->join('diseases', 'reported_diseases.disease_id', '=', 'diseases.id')
                ->select(DB::raw("DATE_FORMAT(reported_diseases.created_at, '%Y-%m') as YearMonth, diseases.disease_name, COUNT(*) as count"))
                ->groupBy('YearMonth', 'diseases.disease_name')
                ->get();

                       

        return view('All-diseases',['diseases'=>$diseases,'profileImg'=>$profileImg,'disease'=>$disease,'no'=>$no,'districts'=>$districts,'DiseaseReported'=>$DiseaseReported,
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
        $Disease = new Disease;
        $destination_path = 'public/images/diseases';
        $Disease->disease_name = $req->disease;
        $Disease->category = $req->category;
        $Disease->description = $req->description;
        $image = $req->file('image');
        $image_name = $image->getClientOriginalName();
        $image_extension = $image->getClientOriginalExtension();
        $image_full_name = $image_name;
        $path = $req->file('image')->storeAs($destination_path, $image_full_name);
        $path = str_replace('public/', '', $path); // remove 'public/' segment from path
        $Disease->image = $path;
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
    
    public function DiseaseUpdate(Request $req, $id){
        $destination_path = 'public/images/diseases';
        $input = Disease::find($id);
        $default_path = $input->image;
        $input->disease_name = $req->input('disease_name');
        $input->category = $req->input('category');
        $input->description = $req->input('description');
        $image = $req->file('image');
        if ($image) {
            // Delete old image if it exists
            if (Storage::disk('local')->exists('public/'.$default_path)) {
                Storage::disk('local')->delete('public/'.$default_path);
            }
            $image_name = $image->getClientOriginalName();
            $image_extension = $image->getClientOriginalExtension();
            $image_full_name = $image_name;
            $path = $req->file('image')->storeAs($destination_path, $image_full_name);
            $path = str_replace('public/', '', $path); 
            $input->image = $path;
        } else {
            $input->image = $default_path;
        }
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

      public function ReportingDisease(Request $request,$id){
//         $reader = new Reader(storage_path('app/GeoLite2-City.mmdb'));

// $ip = '172.17.25.222'; // Replace with the client's IP address

// $record = $reader->city($ip);

// $latitude = $record->location->latitude;
// $longitude = $record->location->longitude;

        
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
