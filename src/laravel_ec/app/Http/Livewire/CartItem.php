<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;

    protected $listeners = [
        'set' => '$set',
    ];

    public function mount()
    {
        $this->item_id = $this->item['id'];
        $this->name    = $this->item['name'];
        $this->price   = $this->item['price'];
        $this->path    = $this->item['path'];
        $this->stock   = $this->item['stock'];
        $this->qty     = $this->item['qty'];
    }

    public function updatedQty()
    {
        $this->updateQtyOfItemsInSession();
    }

    public function render()
    {
        $this->emitTo('components.total-amount-in-cart', 'refresh');
        $this->emitTo('components.qty-in-cart', 'refresh');

        return view('livewire.cart-item');
    }

    private function updateQtyOfItemsInSession()
    {
        /* NOTE: コレクションを一度配列に変換しないと配列内の要素を更新できない */
        $items = \Util::getItemsInTheSession()->toArray();
        $items[$this->item_id]['qty'] = $this->qty;

        session()->put('items', collect($items));
    }

    public function removeItem()
    {
        $items = \Util::getItemsInTheSession();
        $items->forget($this->item_id);

        if ($items->isEmpty()) {
            session()->forget('items');
        }

        $this->emitTo('cart', 'refresh');
    }
}
