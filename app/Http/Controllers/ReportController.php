<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Stock;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

    public function StockReportGeneration(Request $req){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);  
      $start=$req->starting_date;
      $end=$req->ending_date;
      $format=$req->format;
      if($format==="PDF"){
        $stocks = DB::table('stocks')
            ->whereBetween('created_at', [$start, $end])
            ->get();
            $no=0;
            return view('Manager/Report-data',['stocks'=>$stocks,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
      }  
    
    }

    public function SalesReportGeneration(Request $req){
      $user_id=auth()->user()->id;
      $profileImg=User::find($user_id);  
      $start=$req->starting_date;
      $end=$req->ending_date;
      $format=$req->format;
      if($format==="PDF"){
        $sales = DB::table('sales')
            ->whereBetween('created_at', [$start, $end])
            ->get();
            $no=0;
            return view('Manager/Sales-Report-data',['sales'=>$sales,
            'profileImg'=>$profileImg,'start'=>$start,'end'=>$end,'no'=>$no]);
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
        $dompdf->setPaper('A4', 'portrait');
        
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
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the PDF
        $dompdf->render();
        
        // Output the PDF
        return $dompdf->stream('stocks.pdf');
    }
}
