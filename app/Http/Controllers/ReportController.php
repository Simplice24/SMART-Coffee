<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Stock;
use App\Models\Sales;
use App\Models\User;
use App\Models\Cooperative;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ReportController extends Controller
{
    public function DurationForm(){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      return view('Manager/DurationForm',['profileImg'=>$profileImg]);
    }

    public function SalesDurationForm(){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      return view('Manager/Sales-DurationForm',['profileImg'=>$profileImg]);
    }

    public function FarmersReportDuration(Request $req){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      return view('Manager/Farmer-DurationForm',['profileImg'=>$profileImg]);
    }

    public function StockReportGeneration(Request $req){
      $validator = Validator::make($req->all(), [
        'starting_date' => 'required|date',
        'ending_date' => 'required|date|after_or_equal:starting_date',
        'format' => 'required|in:PDF,Excel File',
    ]);

    // If validation fails, redirect back with error messages
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);  
      $start=$req->starting_date;
      $end=$req->ending_date;
      $format=$req->format;
      
      if($format==="PDF"){
        $cooperativeId=DB::table('cooperative_user')
                       ->where('user_id',$user_id)->value('cooperative_id');
        $stocks = DB::table('stocks')
            ->whereBetween('created_at', [$start, $end])
            ->where('cooperative_id',$cooperativeId)
            ->get();
            $no=0;
            return view('Manager/Report-data',['stocks'=>$stocks,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
      }else{
        return redirect()->back();
      }
    
    }

    public function SalesReportGeneration(Request $req){
      $validator = Validator::make($req->all(), [
        'starting_date' => 'required|date',
        'ending_date' => 'required|date|after_or_equal:starting_date',
        'format' => 'required|in:PDF,Excel File',
    ]);

    // If validation fails, redirect back with error messages
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);  
      $start=$req->starting_date;
      $end=$req->ending_date;
      $format=$req->format;
      if($format==="PDF"){
        $cooperativeId=DB::table('cooperative_user')
        ->where('user_id',$user_id)->value('cooperative_id');
        $sales = DB::table('sales')
            ->whereBetween('created_at', [$start, $end])
            ->where('cooperative_id',$cooperativeId)
            ->get();
            $no=0;
            return view('Manager/Sales-Report-data',['sales'=>$sales,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
      }else{
        return redirect()->back();
      }  
    }

    public function FarmerReportGeneration(Request $req){
      $validator = Validator::make($req->all(), [
        'starting_date' => 'required|date',
        'ending_date' => 'required|date|after_or_equal:starting_date',
        'format' => 'required|in:PDF,Excel File',
    ]);

    // If validation fails, redirect back with error messages
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);  
      $start=$req->starting_date;
      $end=$req->ending_date;
      $format=$req->format;
      if($format==="PDF"){
        $cooperativeId=DB::table('cooperative_user')
        ->where('user_id',$user_id)->value('cooperative_id');
        $farmers = DB::table('farmers')
            ->whereBetween('created_at', [$start, $end])
            ->where('cooperative_id',$cooperativeId)
            ->get();
            $no=0;
            return view('Manager/Farmer-Report-data',['farmers'=>$farmers,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
      }else{
        return redirect()->back();
      } 
    }

    public function generatePDF() {
        $stocks = json_decode(urldecode(request('stocks')), true);
        $start = request()->input('start');
        $end = request()->input('end');
        $no=0;
        // Render the view as HTML
        $html = view('Manager/stock-pdf', ['stocks' => $stocks,'no'=>$no,'start'=>$start,'end'=>$end])->render();
        
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        
        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);
        
        // Set the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        
        // Render the PDF
        $dompdf->render();
        
        // Output the PDF
        return $dompdf->stream('stocks.pdf');
    }

    public function SalesGeneratePDF(){
        $sales = json_decode(urldecode(request('sales')), true);
        $start = request()->input('start');
        $end = request()->input('end');
        $no=0;
        // Render the view as HTML
        $html = view('Manager/sales-pdf', ['sales' => $sales,'no'=>$no,'start'=>$start,'end'=>$end])->render();
        
        // Create a new Dompdf instance
        $dompdf = new Dompdf();
        
        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);
        
        // Set the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');
        
        // Render the PDF
        $dompdf->render();
        
        // Output the PDF
        return $dompdf->stream('sales.pdf');
    }

    public function FarmersPDFGeneration(){
      $farmers = json_decode(urldecode(request('farmers')), true);
      $start = request()->input('start');
      $end = request()->input('end');
      $no=0;
      // Render the view as HTML
      $html = view('Manager/farmers-pdf', ['farmers' => $farmers,'no'=>$no,'start'=>$start,'end'=>$end])->render();
      
      // Create a new Dompdf instance
      $dompdf = new Dompdf();
      
      // Load the HTML into Dompdf
      $dompdf->loadHtml($html);
      
      // Set the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');
      
      // Render the PDF
      $dompdf->render();
      
      // Output the PDF
      return $dompdf->stream('farmers.pdf');
  }

  //Admin's report functions

  public function UsersReportDuration(){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);
      return view('UsersDurationForm',['profileImg'=>$profileImg]);
  }

  public function AdminCoopReportDuration(){
     $user_id=auth()->user()->id;
     $profileImg=User::find($user_id);
     return view('CooperativesDurationForm',['profileImg'=>$profileImg]); 
  }

  public function AdminFarmersReportDuration(){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    return view('FarmersDurationForm',['profileImg'=>$profileImg]);
  }

  public function AdminDiseasesReportDuration(){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    return view('DiseasesDurationForm',['profileImg'=>$profileImg]);
  }

  public function UsersReportGeneration(Request $req){
    $validator = Validator::make($req->all(), [
      'starting_date' => 'required|date',
      'ending_date' => 'required|date|after_or_equal:starting_date',
      'format' => 'required|in:PDF,Excel File',
  ]);

  // If validation fails, redirect back with error messages
  if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
  }
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);  
    $start=$req->starting_date;
    $end=$req->ending_date;
    $format=$req->format;
    if($format==="PDF"){
      $users = DB::table('users')
          ->whereBetween('created_at', [$start, $end])
          ->get();
          $no=0;
          return view('User-Report-data',['users'=>$users,
          'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }else{
      return redirect()->back();
    } 
  }

  public function CooperativesReportGeneration(Request $req){
    $validator = Validator::make($req->all(), [
      'starting_date' => 'required|date',
      'ending_date' => 'required|date|after_or_equal:starting_date',
      'format' => 'required|in:PDF,Excel File',
  ]);

  // If validation fails, redirect back with error messages
  if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
  }
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);  
    $start=$req->starting_date;
    $end=$req->ending_date;
    $format=$req->format;
    if($format==="PDF"){
      $cooperatives = DB::table('cooperatives')
          ->whereBetween('created_at', [$start, $end])
          ->get();
          $no=0;
          return view('Cooperative-Report-data',['cooperatives'=>$cooperatives,
          'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }else{
      return redirect()->back();
    }
  }

  public function AdminFarmersReportGeneration(Request $req){
    $validator = Validator::make($req->all(), [
      'starting_date' => 'required|date',
      'ending_date' => 'required|date|after_or_equal:starting_date',
      'format' => 'required|in:PDF,Excel File',
  ]);

  // If validation fails, redirect back with error messages
  if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
  }
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);  
    $start=$req->starting_date;
    $end=$req->ending_date;
    $format=$req->format;
    if($format==="PDF"){
      $farmers = DB::table('farmers')
          ->whereBetween('created_at', [$start, $end])
          ->get();
          $no=0;
          return view('farmers-Report-data',['farmers'=>$farmers,
          'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }else{
      return redirect()->back();
    }
  }

  public function AdminDiseasesReportGeneration(Request $req){
      $validator = Validator::make($req->all(), [
      'starting_date' => 'required|date',
      'ending_date' => 'required|date|after_or_equal:starting_date',
      'format' => 'required|in:PDF,Excel File',
  ]);

  // If validation fails, redirect back with error messages
  if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
  }
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);  
    $start=$req->starting_date;
    $end=$req->ending_date;
    $format=$req->format;
    if($format==="PDF"){
          $diseases = DB::table('diseases')
                ->select('diseases.id', 'diseases.disease_name as name','diseases.category as category','diseases.description as description', DB::raw('count(reported_diseases.id) as count'))
                ->leftJoin('reported_diseases', 'diseases.id', '=', 'reported_diseases.disease_id')
                ->whereBetween('reported_diseases.created_at', [$start, $end])
                ->groupBy('diseases.id', 'name','category','description')
                ->get();
          $no=0;
          return view('disease-Report-data',['diseases'=>$diseases,
          'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }else{
      return redirect()->back();
    }
  }

  public function UsersPDFGeneration(){
      $users = json_decode(urldecode(request('users')), true);
      $start = request()->input('start');
      $end = request()->input('end');
      $no=0;
      // Render the view as HTML
      $html = view('users-pdf', ['users' => $users,'no'=>$no,'start'=>$start,'end'=>$end])->render();
      
      // Create a new Dompdf instance
      $dompdf = new Dompdf();
      
      // Load the HTML into Dompdf
      $dompdf->loadHtml($html);
      
      // Set the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');
      
      // Render the PDF
      $dompdf->render();
      
      // Output the PDF
      return $dompdf->stream('System-users.pdf');
  }

  public function CooperativesPDFGeneration(){
      $cooperatives = json_decode(urldecode(request('cooperatives')), true);
      $start = request()->input('start');
      $end = request()->input('end');
      $no=0;
      // Render the view as HTML
      $html = view('cooperatives-pdf', ['cooperatives' => $cooperatives,'no'=>$no,'start'=>$start,'end'=>$end])->render();
      
      // Create a new Dompdf instance
      $dompdf = new Dompdf();
      
      // Load the HTML into Dompdf
      $dompdf->loadHtml($html);
      
      // Set the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');
      
      // Render the PDF
      $dompdf->render();
      
      // Output the PDF
      return $dompdf->stream('Cooperatives.pdf');
  }

  public function AdminFarmersPDFGeneration(){
      $farmers = json_decode(urldecode(request('farmers')), true);
      $start = request()->input('start');
      $end = request()->input('end');
      $no=0;
      // Render the view as HTML
      $html = view('farmers-pdf', ['farmers' => $farmers,'no'=>$no,'start'=>$start,'end'=>$end])->render();
      
      // Create a new Dompdf instance
      $dompdf = new Dompdf();
      
      // Load the HTML into Dompdf
      $dompdf->loadHtml($html);
      
      // Set the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');
      
      // Render the PDF
      $dompdf->render();
      
      // Output the PDF
      return $dompdf->stream('Farmers.pdf');
  }

  public function DiseasesPDFGeneration(){
      $diseases = json_decode(urldecode(request('diseases')), true);
      $start = request()->input('start');
      $end = request()->input('end');
      $no=0;
      // Render the view as HTML
      $html = view('diseases-pdf', ['diseases' => $diseases,'no'=>$no,'start'=>$start,'end'=>$end])->render();
      
      // Create a new Dompdf instance
      $dompdf = new Dompdf();
      
      // Load the HTML into Dompdf
      $dompdf->loadHtml($html);
      
      // Set the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');
      
      // Render the PDF
      $dompdf->render();
      
      // Output the PDF
      return $dompdf->stream('Diseases.pdf');
  }

  //Official's report functions

  public function ManagersReportDuration(){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    return view('Official/ManagersDurationForm',['profileImg'=>$profileImg]);
  }

  public function CooperativesReportDuration(){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    return view('Official/CooperativesDurationForm',['profileImg'=>$profileImg]);
  }

  public function FarmerReportDuration(){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    return view('Official/FarmerDurationForm',['profileImg'=>$profileImg]);
  }

  public function ManagersReportGeneration(Request $req){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    $user_role=User::where('id',$user_id)->value('role');
    $users_location=User::select('province','district','sector','cell')
                      ->where('id',$user_id)
                      ->get();
    $validator = Validator::make($req->all(), [
      'starting_date' => 'required|date',
      'ending_date' => 'required|date|after_or_equal:starting_date',
      'format' => 'required|in:PDF,Excel File',
  ]);

  // If validation fails, redirect back with error messages
  if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
  }
    $start=$req->starting_date;
    $end=$req->ending_date;
    $format=$req->format;
    if($format==="PDF" && $user_role==="SEDO"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                  ->whereIn('district', $users_location->pluck('district'))
                  ->whereIn('sector', $users_location->pluck('sector'))
                  ->whereIn('cell', $users_location->pluck('cell'))
                  ->get();
              $cooperativeIds = $Cooperatives->pluck('id');
      
              $managerIds = DB::table('cooperative_user')
                  ->whereIn('cooperative_id', $cooperativeIds)
                  ->pluck('user_id'); 
          
              $managers = DB::table('users')
                  ->whereIn('users.id', $managerIds)
                  ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
                  ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
                  ->whereIn('cooperatives.id', $cooperativeIds)
                  ->whereBetween('users.created_at',[$start,$end])
                  ->select('users.name as manager_name','users.gender as gender','users.email as email','users.phone as phone','cooperatives.name as cooperative_name')
                  ->get();
              
              $no=0;
              return view('Official/Manager-Report-data',['managers'=>$managers,
              'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
        }elseif($format==="PDF" && $user_role==="Sector-agro"){
          $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
          ->whereIn('district', $users_location->pluck('district'))
          ->whereIn('sector', $users_location->pluck('sector'))
          ->get();
            $cooperativeIds = $Cooperatives->pluck('id');

            $managerIds = DB::table('cooperative_user')
                ->whereIn('cooperative_id', $cooperativeIds)
                ->pluck('user_id'); 

            $managers = DB::table('users')
                ->whereIn('users.id', $managerIds)
                ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
                ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
                ->whereIn('cooperatives.id', $cooperativeIds)
                ->whereBetween('users.created_at',[$start,$end])
                ->select('users.name as manager_name','users.gender as gender','users.email as email','users.phone as phone','cooperatives.name as cooperative_name')
                ->get();
            
            $no=0;
            return view('Official/Manager-Report-data',['managers'=>$managers,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }elseif($format==="PDF" && $user_role==="District-agro"){
      $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
      ->whereIn('district', $users_location->pluck('district'))
      ->get();
              $cooperativeIds = $Cooperatives->pluck('id');

              $managerIds = DB::table('cooperative_user')
                  ->whereIn('cooperative_id', $cooperativeIds)
                  ->pluck('user_id'); 

              $managers = DB::table('users')
                  ->whereIn('users.id', $managerIds)
                  ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
                  ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
                  ->whereIn('cooperatives.id', $cooperativeIds)
                  ->whereBetween('users.created_at',[$start,$end])
                  ->select('users.name as manager_name','users.gender as gender','users.email as email','users.phone as phone','cooperatives.name as cooperative_name')
                  ->get();
              
              $no=0;
              return view('Official/Manager-Report-data',['managers'=>$managers,
              'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }else{

        $managerIds = DB::table('cooperative_user')
            ->pluck('user_id'); 

        $managers = DB::table('users')
            ->whereIn('users.id', $managerIds)
            ->leftJoin('cooperative_user', 'users.id', '=', 'cooperative_user.user_id')
            ->leftJoin('cooperatives', 'cooperative_user.cooperative_id', '=', 'cooperatives.id')
            ->whereBetween('users.created_at',[$start,$end])
            ->select('users.name as manager_name','users.gender as gender','users.email as email','users.phone as phone','cooperatives.name as cooperative_name')
            ->get();
        
        $no=0;
        return view('Official/Manager-Report-data',['managers'=>$managers,
        'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }
  }

  public function CooperativeReportGeneration(Request $req){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    $user_role=User::where('id',$user_id)->value('role');
    $users_location=User::select('province','district','sector','cell')
                      ->where('id',$user_id)
                      ->get();
    $validator = Validator::make($req->all(), [
      'starting_date' => 'required|date',
      'ending_date' => 'required|date|after_or_equal:starting_date',
      'format' => 'required|in:PDF,Excel File',
  ]);

  // If validation fails, redirect back with error messages
  if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
  }
    $start=$req->starting_date;
    $end=$req->ending_date;
    $format=$req->format;
    if($format==="PDF" && $user_role==="SEDO"){
              $cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                  ->whereIn('district', $users_location->pluck('district'))
                  ->whereIn('sector', $users_location->pluck('sector'))
                  ->whereIn('cell', $users_location->pluck('cell'))
                  ->whereBetween('created_at',[$start,$end])
                  ->get();
              
              $no=0;
              return view('Official/Cooperative-Report-data',['cooperatives'=>$cooperatives,
              'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
        }elseif($format==="PDF" && $user_role==="Sector-agro"){
            $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                          ->whereIn('district', $users_location->pluck('district'))
                          ->whereIn('sector', $users_location->pluck('sector'))
                          ->whereBetween('created_at',[$start,$end])
                          ->get();
            
            $no=0;
            return view('Official/Cooperative-Report-data',['cooperatives'=>$cooperatives,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }elseif($format==="PDF" && $user_role==="District-agro"){
            $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                          ->whereIn('district', $users_location->pluck('district'))
                          ->whereBetween('created_at',[$start,$end])
                          ->get();
              
              $no=0;
              return view('Official/Cooperative-Report-data',['cooperatives'=>$cooperatives,
              'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }else{ 
        $cooperatives=Cooperative::whereBetween('created_at',[$start,$end])->get();
        
        $no=0;
        return view('Official/Cooperative-Report-data',['cooperatives'=>$cooperatives,
        'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }
  }

  public function FarmersReportGeneration(Request $req){
    $user_id=auth()->user()->id;
    $profileImg=User::find($user_id);
    $user_role=User::where('id',$user_id)->value('role');
    $users_location=User::select('province','district','sector','cell')
                      ->where('id',$user_id)
                      ->get();
    $validator = Validator::make($req->all(), [
      'starting_date' => 'required|date',
      'ending_date' => 'required|date|after_or_equal:starting_date',
      'format' => 'required|in:PDF,Excel File',
  ]);

  // If validation fails, redirect back with error messages
  if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
  }
    $start=$req->starting_date;
    $end=$req->ending_date;
    $format=$req->format;
    if($format==="PDF" && $user_role==="SEDO"){
              $cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                  ->whereIn('district', $users_location->pluck('district'))
                  ->whereIn('sector', $users_location->pluck('sector'))
                  ->whereIn('cell', $users_location->pluck('cell'))
                  ->whereBetween('created_at',[$start,$end])
                  ->get();

              $farmersIds=$cooperatives->pluck('id');
              
              $farmers=DB::table('farmers')
                       ->whereIn('cooperative_id',$farmersIds)
                       ->get();
              
              $no=0;
              return view('Official/Farmer-Report-data',['farmers'=>$farmers,
              'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
        }elseif($format==="PDF" && $user_role==="Sector-agro"){
            $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                          ->whereIn('district', $users_location->pluck('district'))
                          ->whereIn('sector', $users_location->pluck('sector'))
                          ->whereBetween('created_at',[$start,$end])
                          ->get();

            $farmersIds=$cooperatives->pluck('id');
              
            $farmers=DB::table('farmers')
                     ->whereIn('cooperative_id',$farmersIds)
                     ->get();              
            
            $no=0;
            return view('Official/Farmer-Report-data',['farmers'=>$farmers,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }elseif($format==="PDF" && $user_role==="District-agro"){
              $Cooperatives = Cooperative::whereIn('province', $users_location->pluck('province'))
                          ->whereIn('district', $users_location->pluck('district'))
                          ->whereBetween('created_at',[$start,$end])
                          ->get();

              $farmersIds=$cooperatives->pluck('id');
              
              $farmers=DB::table('farmers')
                       ->whereIn('cooperative_id',$farmersIds)
                       ->get();
              
              $no=0;
              return view('Official/Farmer-Report-data',['farmers'=>$farmers,
              'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }else{ 
        $cooperatives=Cooperative::whereBetween('created_at',[$start,$end])->get();

        $farmersIds=$cooperatives->pluck('id');
              
        $farmers=DB::table('farmers')
                       ->whereIn('cooperative_id',$farmersIds)
                       ->get();
        
        $no=0;
        return view('Official/Farmer-Report-data',['farmers'=>$farmers,
        'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
    }
  }

  public function ManagersPDFGeneration(){
      $managers = json_decode(urldecode(request('managers')), true);
      $start = request()->input('start');
      $end = request()->input('end');
      $no=0;
      // Render the view as HTML
      $html = view('Official/managers-pdf', ['managers' => $managers,'no'=>$no,'start'=>$start,'end'=>$end])->render();
      
      // Create a new Dompdf instance
      $dompdf = new Dompdf();
      
      // Load the HTML into Dompdf
      $dompdf->loadHtml($html);
      
      // Set the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');
      
      // Render the PDF
      $dompdf->render();
      
      // Output the PDF
      return $dompdf->stream('Managers.pdf');
  }

  public function CooperativePDFGeneration(){
    $cooperatives = json_decode(urldecode(request('cooperatives')), true);
    $start = request()->input('start');
    $end = request()->input('end');
    $no=0;
    // Render the view as HTML
    $html = view('Official/cooperatives-pdf', ['cooperatives' => $cooperatives,'no'=>$no,'start'=>$start,'end'=>$end])->render();
    
    // Create a new Dompdf instance
    $dompdf = new Dompdf();
    
    // Load the HTML into Dompdf
    $dompdf->loadHtml($html);
    
    // Set the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    
    // Render the PDF
    $dompdf->render();
    
    // Output the PDF
    return $dompdf->stream('Cooperatives.pdf');
  }

  public function FarmerPDFGeneration(){
    $farmers = json_decode(urldecode(request('farmers')), true);
    $start = request()->input('start');
    $end = request()->input('end');
    $no=0;
    // Render the view as HTML
    $html = view('Official/farmers-pdf', ['farmers' => $farmers,'no'=>$no,'start'=>$start,'end'=>$end])->render();
    
    // Create a new Dompdf instance
    $dompdf = new Dompdf();
    
    // Load the HTML into Dompdf
    $dompdf->loadHtml($html);
    
    // Set the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');
    
    // Render the PDF
    $dompdf->render();
    
    // Output the PDF
    return $dompdf->stream('Farmers.pdf');
  }
}
