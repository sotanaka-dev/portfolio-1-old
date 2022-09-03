<?php

namespace App\Http\Livewire\Fav;

use Livewire\Component;

class Item extends Component
{
    public $fav;

    public function render()
    {
        return view('livewire.fav.item');
    }

    public function rmFromFav()
    {
        $this->dispatchBrowserEvent(
            'rm_from_fav',
            ['id' => $this->fav['id']]
        );

        $this->dispatchBrowserEvent(
            'after_rm_from_fav',
            ['id' => $this->fav['id']]
        );

        $this->emitTo('fav.qty-in-item-list', 'decrement');
    }
}
