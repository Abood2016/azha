<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TopBar extends Component
{
    protected $listeners = [
        'refresh-tob-bar' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.top-bar');
    }
}
