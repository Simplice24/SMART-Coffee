<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Stock;
use App\Models\Sales;
use App\Models\User;
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
}
