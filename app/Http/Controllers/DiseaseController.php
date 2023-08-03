<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Disease;
use App\Models\Confidence;
use App\Models\Cooperative;
use App\Models\ReportedByPrediction;
use App\Models\ReportedDisease;
use Illuminate\Support\Facades\DB;
use GeoIp2\Database\Reader;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
                    ['name' => 'Gasabo', 'latitude' => -1.950000000000000, 'longitude' => 30.058600000000000],
                    ['name' => 'Kicukiro', 'latitude' => -1.957500000000000, 'longitude' => 30.169400000000000],
                    ['name' => 'Nyarugenge', 'latitude' =>  -1.946900000000000, 'longitude' => 30.140800000000000],

                    ['name' => 'Nyanza', 'latitude' => -2.365900000000000, 'longitude' => 29.744400000000000],
                    ['name' => 'Huye', 'latitude' => -2.598200000000000, 'longitude' => 29.742000000000000],
                    ['name' => 'Gisagara', 'latitude' => -2.594000000000000, 'longitude' =>  29.831400000000000],
                    ['name' => 'Kamonyi', 'latitude' => -2.010646729869389, 'longitude' =>  29.909486130568729],
                    ['name' => 'Muhanga', 'latitude' => -2.077000000000000, 'longitude' => 29.759800000000000],
                    ['name' => 'Ruhango', 'latitude' =>  -2.242500000000000, 'longitude' => 29.787000000000000],
                    ['name' => 'Nyamagabe', 'latitude' => -2.554559130186813, 'longitude' => 29.565204365847298],
                    ['name' => 'Nyaruguru', 'latitude' => -2.698700000000000, 'longitude' => 29.570300000000000],

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

    public function RealtimeDiseases(){
        $no=0;
        $noo=0;
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $disease=Disease::all();
        $currentMonth = date('m');
        $currentYear=date('Y');
        $YearMonth=date('Y-m');
        $monthlyCounts = DB::table('reported_by_prediction')
                    ->select(
                        DB::raw('MONTH(created_at) as month'),
                        'predicted_class as disease_name',
                        DB::raw('COUNT(*) as count')
                    )
                    ->whereRaw('MONTH(created_at) = ?', [$currentMonth])
                    ->groupBy('month', 'predicted_class')
                    ->get();

        $yearlyCounts = DB::table('reported_by_prediction')
                    ->select(
                        DB::raw('YEAR(created_at) as year'),
                        'predicted_class as disease_name',
                        DB::raw('COUNT(*) as count')
                    )
                    ->whereRaw('YEAR(created_at) = ?', [$currentYear])
                    ->groupBy('year', 'predicted_class')
                    ->get();

                    $diseases = DB::table('reported_by_prediction')
                    ->select(
                        'reported_by_prediction.*',
                        'reported_by_prediction.predicted_class as disease_name',
                        DB::raw('COUNT(reported_by_prediction.predicted_class) as disease_count')
                    )
                    ->groupBy(
                        'reported_by_prediction.id',
                        'reported_by_prediction.cooperative_id',
                        'reported_by_prediction.predicted_class',
                        'reported_by_prediction.confidence',
                        'reported_by_prediction.image',
                        'reported_by_prediction.longitude',
                        'reported_by_prediction.latitude',
                        'reported_by_prediction.created_at',
                        'reported_by_prediction.updated_at'
                    )
                    ->get();

        $realtimeDiseases = DB::table('reported_by_prediction')
                    ->select(
                        'reported_by_prediction.id',
                        'reported_by_prediction.cooperative_id',
                        'predicted_class',
                        'confidence',
                        'reported_by_prediction.created_at',
                        'cooperatives.name',
                        'cooperatives.district',
                        'cooperatives.sector',
                        'cooperatives.cell'
                    )
                    ->join('cooperatives', 'reported_by_prediction.cooperative_id', '=', 'cooperatives.id')
                    ->get();
                

        $reportingConfidence = DB::table('confidence')
                            ->select('id','confidence','status','set_by','created_at')
                            ->get();        
             
        $DiseaseReported = DB::table('reported_by_prediction')
                            ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as YearMonth, predicted_class, COUNT(*) as count"))
                            ->groupBy('YearMonth', 'predicted_class')
                            ->get();

                       
        return view('Realtime-diseases',['realtimeDiseases' =>$realtimeDiseases,'diseases'=>$diseases,'profileImg'=>$profileImg,'disease'=>$disease,'no'=>$no,'DiseaseReported'=>$DiseaseReported,
        'noo'=>$noo,'monthlyCounts'=>$monthlyCounts,'yearlyCounts'=>$yearlyCounts,'reportingConfidence'=>$reportingConfidence]);
    
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
        $reportingConfidence = Confidence::where('status', 1)->get(['confidence']);
        return view('Manager/Diseases',['profileImg'=>$profileImg,'disease'=>$disease,'reportingConfidence'=>$reportingConfidence]);
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

    public function RealtimeDiseaseDetailsPage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $diseaseinfo=ReportedByPrediction::find($id);
        $cooperativeId = $diseaseinfo->cooperative_id;
        $cooperative_name = DB::table('cooperatives')
                                ->where('id', $cooperativeId)
                                ->value('name');
                                
        return view('Realtime-disease-details',['diseaseinfo'=>$diseaseinfo,'profileImg'=>$profileImg,'cooperative_name' =>$cooperative_name]);
    }

    public function ConfidenceRegistration(Request $request){
         // Validate the request
         $request->validate([
            'confidence' => 'required|numeric|min:0|max:100',
        ]);

        // Save the confidence
        $user_id= auth()->user()->id;
        $admin_name=User::where('id',$user_id)->value('name');
        $conf = $request->input('confidence');
        $Confidence = new Confidence;
        $Confidence->confidence = $conf;
        $Confidence->set_by=$admin_name;
        $Confidence->save();

        return redirect('realtimediseases');
        
    }

    public function activateConfidence($id){
        Confidence::query()->update(['status' => 0]);
        $conf=Confidence::find($id);
        $conf->status = 1;
        $conf->save();
        return redirect('realtimediseases');
    }

    public function deactivateConfidence($id){
        $conf=Confidence::find($id);
        $conf->status = 0;
        $conf->save();
        return redirect('realtimediseases');
    }

    public function deleteConfidence($id){
        Confidence::find($id)->delete();
        return redirect('realtimediseases');
    }

    public function DiseaseUpdatePage($id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);    
        $diseaseinfo=Disease::find($id);
        return view('Disease-update',['diseaseinfo'=> $diseaseinfo,'profileImg'=>$profileImg]);
    }

    public function DeleteRealtimeDisease($id){
        $disease=ReportedByPrediction::find($id);
        if($disease){
            $image_path = 'prediction/' . basename($disease->image);
            ReportedByPrediction::find($id)->delete();
            Storage::delete($image_path);
        }
        
        return redirect('realtimediseases');

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

      public function CooperativeDiseaseDetails(Request $request,$id){
        $userId =auth()->user()->id;
        $profileImg=User::find($userId);
        $diseaseinfo=Disease::find($id);
        return view('Manager/Disease-details',['diseaseinfo'=>$diseaseinfo,'profileImg'=>$profileImg]);
      }

      public function ReportingDisease(Request $request, $id)
        {
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            
            $Manager_id = auth()->user()->id;
            $cooperative_id = DB::table('cooperative_user')
                                ->where('user_id', $Manager_id)
                                ->value('cooperative_id');
            
            $reported_disease = new ReportedDisease();
            $reported_disease->cooperative_id = $cooperative_id;
            $reported_disease->disease_id = $id;
            $reported_disease->disease_category = Disease::where('id', $id)->value('category');
            // Set the latitude and longitude values in the reported disease
            $reported_disease->latitude = $latitude;
            $reported_disease->longitude = $longitude;

            if ($reported_disease->save()) {
                return redirect()->back()->with('success', 'Disease reported successfully');
            } else {
                return redirect()->back()->with('error', 'Something went wrong, disease not reported');
            }
        }

      public function deleteReportedDisease($id)
      {
        ReportedDisease::where('disease_id',$id)->delete();
        return redirect('viewdiseases');
      }


}
