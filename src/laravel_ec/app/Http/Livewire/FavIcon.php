<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FavIcon extends Component
{
    public $product;
    public $product_id;

    public function mount()
    {
        $this->product_id = $this->product->id;
    }

    public function render()
    {
        /* NOTE: favアイコンを押下して個別に商品が再レンダリングされる際の処理 */
        $this->dispatchBrowserEvent(
            'after_async_process',
            ['id' => $this->product->id]
        );

        return view('livewire.fav-icon');
    }

    public function addToFav()
    {
        $this->dispatchBrowserEvent(
            'add_to_fav',
            [
                'id'    => $this->product->id,
                'name'  => $this->product->name,
                'price' => $this->product->price,
                'path'  => $this->product->path,
            ]
        );

        $this->emitTo('qty-in-fav-list', 'increment');
    }

    public function rmFromFav()
    {
        $this->dispatchBrowserEvent(
            'rm_from_fav',
            ['id' => $this->product->id,]
        );

        $this->emitTo('qty-in-fav-list', 'decrement');
    }
}
