<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Report extends Component
{
    public $data;
    public $jenislaporan = 'harian';

    public function render()
    {
        return view('livewire.report');
    }
}
