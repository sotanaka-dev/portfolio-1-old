<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class QtyInFavList extends Component
{
    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.components.qty-in-fav-list');
    }
}
