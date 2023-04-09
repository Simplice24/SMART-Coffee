<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Sales;
use App\Models\User;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function SalesRecording(Request $request){
        $validatedData = $request->validate([
            'customer' => 'required|string|min:1',
            'product' => 'required|string',
            'payment' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $Manager_id=auth()->user()->id;
        $cooperative_id=DB::table('cooperative_user')
        ->where('user_id',$Manager_id)
        ->value('cooperative_id'); 

         $input=$request->all();
         $sales=new Sales();
         $sales->customer=$input['customer'];
         $sales->product=$input['product'];
         $sales->quantity=$input['quantity'];
         $sales->price=$input['price'];
         $sales->payment=$input['payment'];
         $sales->cooperative_id=$cooperative_id;

         $availableQuantity=DB::table('stocks')
         ->where('cooperative_id',$cooperative_id)
         ->where('product',$input['product'])
         ->sum('quantity');
         $difference=$availableQuantity-$sales->quantity;
         if($difference>=0){
            $sales->save();
         }
         else{
            return redirect()->back()->with('error', 'Not enough quantity in stock');
         }

         return redirect()->back()->with('success','Recorded successfully');

    }

    public function SalesUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'customer' => 'required|string|min:1',
            'product' => 'required|string',
            'payment' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $input=Sales::find($id);
        $input->customer=$request->input('customer');
        $input->product=$request->input('product');
        $input->payment=$request->input('payment');
        $input->price=$request->input('price');
        $input->quantity=$request->input('quantity');
        $input->update();

        return redirect('CooperativeSales');
    }

    
}
