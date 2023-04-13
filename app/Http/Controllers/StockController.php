<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\User;
use App\Models\Farmer;
use App\Models\CooperativeStock;
use Illuminate\Support\Facades\DB;
class StockController extends Controller
{
    public function StockDetails(){
      $user_id=auth()->user()->id;
      $i=0;
      $profileImg=User::find($user_id);
      $cooperative_id = DB::table('cooperative_user')
                   ->where('user_id', $user_id)
                   ->value('cooperative_id');
      if($cooperative_id){
        // $Cooperativefarmers=DB::table('farmers')
        //                     ->where('cooperative_id',$cooperative_id)
        //                     ->get();
        $CooperativeStock=Stock::where('cooperative_id',$cooperative_id)->paginate(10);
        $CooperativeStockByCategory=DB::table('stocks')
        ->select('product', DB::raw('SUM(quantity) as total_quantity'))
        ->where('cooperative_id', $cooperative_id)
        ->groupBy('product')
        ->get();
        $CooperativeStockInventoryByCategory=DB::table('cooperative_stocks')
        ->select('product_category', DB::raw('SUM(quantity) as total_quantity'))
        ->where('cooperative_id', $cooperative_id)
        ->groupBy('product_category')
        ->get();
        return view('Manager/Cooperative-stock',['i'=>$i,'profileImg'=>$profileImg,
        'CooperativeStock'=>$CooperativeStock,'CooperativeStockByCategory'=>$CooperativeStockByCategory,
        'CooperativeStockInventoryByCategory'=>$CooperativeStockInventoryByCategory]);
      }             
    }

    public function StockRecording(Request $request){
      $validatedData = $request->validate([
        'product' => 'required|string',
        'quantity' => 'required|numeric|min:1',
        'year' => 'required|date',
        'season' => 'required|string',
      ]);

        $Manager_id=auth()->user()->id;
        $cooperative_id=DB::table('cooperative_user')
        ->where('user_id',$Manager_id)
        ->value('cooperative_id'); 

         $input=$request->all();
         $stock=new Stock();
         $stock->product=$input['product'];
         $stock->quantity=$input['quantity'];
         $stock->year=$input['year'];
         $stock->season=$input['season'];
         $stock->cooperative_id=$cooperative_id;
         if($stock->save()){
          CooperativeStock::updateOrCreate(
            ['product_category' => $stock->product, 'cooperative_id' => $cooperative_id],
            ['quantity' => DB::raw("quantity + $stock->quantity")]
        );
           return redirect()->back()->with('success','Recorded successfully');
         }else{
          return redirect()->back()->with('error','New stock record is not recorded');
         }

         return redirect()->back();

    }

    public function StockUpdate(Request $request,$id){
        $Manager_id=auth()->user()->id;
        $cooperative_id=DB::table('cooperative_user')
                        ->where('user_id',$Manager_id)
                        ->value('cooperative_id'); 
        $input=Stock::find($id);
        $input->product=$request->input('product');
        $input->quantity=$request->input('quantity');
        $input->year=$request->input('year');
        $input->season=$request->input('season');
        $input->cooperative_id=$cooperative_id;
        $input->update();

        return redirect('StockDetails');
    }
}
