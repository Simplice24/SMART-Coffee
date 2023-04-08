<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\User;
use App\Models\Farmer;
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
        $Cooperativefarmers=DB::table('farmers')
                            ->where('cooperative_id',$cooperative_id)
                            ->get();
        $CooperativeStock=Stock::where('cooperative_id',$cooperative_id)->paginate(10);
        $CooperativeStockByCategory=DB::table('stocks')
        ->select('product', DB::raw('SUM(quantity) as total_quantity'))
        ->where('cooperative_id', $cooperative_id)
        ->groupBy('product')
        ->get();
        return view('Manager/Cooperative-stock',['i'=>$i,'profileImg'=>$profileImg,
        'CooperativeStock'=>$CooperativeStock,'Cooperativefarmers'=>$Cooperativefarmers,
        'CooperativeStockByCategory'=>$CooperativeStockByCategory]);
      }             
    }

    public function StockRecording(Request $request){
      $validatedData = $request->validate([
        'product' => 'required|string',
        'quantity' => 'required|numeric|min:1',
        'farmer_id' => 'required|numeric',
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
         $stock->farmer_id=$input['farmer_id'];
         $stock->season=$input['season'];
         $stock->cooperative_id=$cooperative_id;
         $stock->save();

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
        $input->farmer_id=$request->input('farmer_id');
        $input->season=$request->input('season');
        $input->cooperative_id=$cooperative_id;
        $input->update();

        return redirect('StockDetails');
    }
}
