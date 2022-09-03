<?php

namespace App\Http\Livewire\Fav;

use Livewire\Component;

class ItemList extends Component
{
    public $fav_list;

    public function mount()
    {
        $this->fav_list = [];
    }

    public function render()
    {
        return view('livewire.fav.item-list')
            ->extends('layouts.template')
            ->section('content');
    }
}
