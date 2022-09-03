<?php

namespace App\Http\Livewire\Fav;

use Livewire\Component;

class QtyInItemList extends Component
{
    public $qty;
    /* Fav, FavItemでお気に入りに追加、削除時にemitToで呼び出し */
    protected $listeners = [
        'increment' => 'increment',
        'decrement' => 'decrement',
    ];

    public function mount()
    {
        $this->qty = 0;
    }

    public function render()
    {
        return view('livewire.fav.qty-in-item-list');
    }

    public function increment()
    {
        $this->qty++;
    }

    public function decrement()
    {
        $this->qty--;
    }
}
