<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        return view('livewire.services', [
            'services' => Service::latests()->get()
        ]);
    }
}
