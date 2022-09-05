<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Cart extends Component
{
    public function render(Request $request)
    {
        return view(
            'livewire.cart.index',
            ['items' => \Util::getItemsInTheSession($request)]
        )
            ->extends('layouts.template')
            ->section('content');
    }

    public function addProduct(Request $request)
    {
        $id    = $request->get('id');
        $qty   = $request->get('qty');
        $items = \Util::getItemsInTheSession($request);

        if ($items->has($id)) {
            $items[$id]->qty += $qty;
        } else {
            $items->put($id, (object)$request->all());
        }
        $request->session()->put('items', $items);

        return redirect()->route('cart');
    }

    public function increment($id, $qty, $stock, Request $request)
    {
        if ($qty < $stock) {
            $qty++;
            $this->qtyUpdate($id, $qty, $request);
            $this->emitTo('components.qty-in-cart', 'refresh');
        }
    }

    public function decrement($id, $qty, Request $request)
    {
        /* if ($qty > 1) {
            $qty--;
            $this->qtyUpdate($id, $qty, $request);
            $this->emitTo('components.qty-in-cart', 'refresh');
        } */

        $qty--;

        if ($qty) {
            $this->qtyUpdate($id, $qty, $request);
        } else {
            $this->deleteItem($id, $request);
        }
        $this->emitTo('components.qty-in-cart', 'refresh');
    }

    public function qtyUpdate($id, $qty, $request)
    {
        $items = \Util::getItemsInTheSession($request);
        $items[$id]->qty = $qty;

        $request->session()->put('items', $items);
    }

    public function deleteItem($id, Request $request)
    {
        $items = \Util::getItemsInTheSession($request);
        $items->forget($id);
        if ($items->isEmpty()) {
            $request->session()->forget('items');
        }

        $this->emitTo('components.qty-in-cart', 'refresh');
    }
}
