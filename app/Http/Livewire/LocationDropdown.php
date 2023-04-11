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

    public function render()
    {
        
        return view('livewire.location-dropdown', [
            'provinces' => Province::all(),
        ]);
    }

    public $districts = [];

    protected $listeners = ['districts-updated' => 'updateDistricts'];

    public function updateDistricts($districts)
    {
        $this->districts = $districts;
    }


}