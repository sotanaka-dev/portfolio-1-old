<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class QtyInFavList extends Component
{
    private const INIT_VALUE = 0;

    public $qty;
    /* Fav, FavItemでお気に入りに追加、削除時にemitToで呼び出し */
    protected $listeners = [
        'increment' => 'increment',
        'decrement' => 'decrement',
    ];

    public function mount()
    {
        $this->qty = self::INIT_VALUE;
    }

    public function render()
    {
        return view('livewire.components.qty-in-fav-list');
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
