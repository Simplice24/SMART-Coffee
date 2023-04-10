<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Province;
use App\Models\District;


class Dropdown extends Component
{

    public $selectedProvince = null;
    public $districts = null;

    public function render()
    {
        return view('livewire.dropdown',['provinces'=> Province::class::all(),]);
    }

    public function updatedSelectedProvince($provincecode)
    {
        dd($provincecode);
        $this->districts= District::where('provincecode',$provincecode)->get();
    }
}
