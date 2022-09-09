<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Cart extends Component
{
    protected $listeners = [
        'refresh' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.cart', [
            'items' => \Util::getItemsInTheSession()
        ])
            ->extends('layouts.template')
            ->section('content');
    }

    /* TODO: ここをdetailに移動したほうがいいかも */
    public function addProduct(Request $request)
    {
        $id    = $request->get('id');
        $qty   = $request->get('qty');
        $items = \Util::getItemsInTheSession($request);

        if ($items->has($id)) {
            $items = $items->toArray();
            $items[$id]['qty'] += $qty;
        } else {
            $items->put($id, $request->all());
        }
        $request->session()->put('items', collect($items));

        return redirect()->route('cart');
    }
}
