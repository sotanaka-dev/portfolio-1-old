<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QtyInFavList extends Component
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
        return view('livewire.qty-in-fav-list');
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