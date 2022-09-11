<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartItem extends Component
{
    public $item;
    public $qty;

    protected $listeners = [
        'set' => '$set',
    ];

    public function mount()
    {
        $this->qty = $this->item['qty'];
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
        $items[$this->item['id']]['qty'] = $this->item['qty'];

        session()->put('items', collect($items));
    }

    public function removeItem()
    {
        $items = \Util::getItemsInTheSession();
        $items->forget($this->item['id']);

        if ($items->isEmpty()) {
            session()->forget('items');
        }

        $this->emitTo('cart', 'refresh');
    }
}
