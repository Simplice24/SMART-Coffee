<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Province;
use App\Models\District;


class Dropdown extends Component
{

    public $selectedProvince = null;
    public $selectedDistrict = null;
    public $selectedSector = null;
    public $selectedCell = null;
    public $districts = null;

    public function render()
    {
        return view('livewire.dropdown',['provinces'=> Province::class::all(),]);
    }

    public function updateSelectedProvince($provincecode)
    {
        $this->districts= District::where('provincecode',$provincecode)->get();
    }
}
