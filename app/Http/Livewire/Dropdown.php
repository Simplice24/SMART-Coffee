<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Province;


class Dropdown extends Component
{
    public function render()
    {
        return view('livewire.dropdown',['provinces'=> Province::class::all(),]);
    }
}
