<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Production;
use App\Models\Sales;
use App\Models\User;
use App\Models\Stock;
use App\Models\CooperativeStock;
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
            'year' => 'required|date',
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
         $sales->year=$input['year'];
         $sales->cooperative_id=$cooperative_id;
        $cooperativeStock = CooperativeStock::where('product_category', $sales->product)
                            ->where('cooperative_id', $cooperative_id)
                            ->first();

        if ($cooperativeStock && $cooperativeStock->quantity >= $sales->quantity) {
            $cooperativeStock->decrement('quantity', $sales->quantity);
            $sales->save();
            return redirect()->back()->with('success','Recorded successfully');
        } else {
            return redirect()->back()->with('error', 'Not enough quantity in stock');
        }

    }

    public function SalesUpdate(Request $request,$id){
        $validatedData = $request->validate([
            'customer' => 'required|string|min:1',
            'product' => 'required|string',
            'payment' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0',
            'year' => 'required|date',
        ]);

        $input=Sales::find($id);
        $input->customer=$request->input('customer');
        $input->product=$request->input('product');
        $input->payment=$request->input('payment');
        $input->price=$request->input('price');
        $input->quantity=$request->input('quantity');
        $input->year=$request->input('year');
        $input->update();

        return redirect('CooperativeSales');
    }

    
}
