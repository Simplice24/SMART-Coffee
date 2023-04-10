<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Province;
use App\Models\District;
use App\Models\Sector;
use App\Models\Cell;
use App\Models\Village;
class LocationDropdown extends Component
{


    public $selectedProvince = null;
    public $selectedDistrict = null;
    public $selectedSector = null;
    public $selectedCell = null;
    public $selectedVillage = null;
    public $districts = null;
    public $sectors = null;
    public $cells = null;
    public $villages = null;

    public function render()
    {


        // $provinces = Province::all();
        
        return view('livewire.location-dropdown', [
            'provinces' => Province::all(),
        ]);
    }

    public function updatedSelectedProvince($provincecode)
    {
        $this->districts = District::where('provincecode', $provincecode)->get();
    }


    public function updatedSelectedDistrict($districtcode)
    {
        $this->sectors = Sector::where('districtcode', $districtcode)->get();
        // dd($sectors);
        // $this->reset(['selectedSector', 'selectedCell', 'selectedVillage']);
    }


    public function updatedSelectedSector($sectorcode)
    {
       $this->cells = Cell::where('sectorcode', $sectorcode)->get();
        // dd($sectors);
        // $this->reset(['selectedSector', 'selectedCell', 'selectedVillage']);
    }

    public function updatedSelectedCell($codecell)
    {
       $this->villages = Village::where('codecell', $codecell)->get();
        // dd($sectors);
        // $this->reset(['selectedSector', 'selectedCell', 'selectedVillage']);
    }



}