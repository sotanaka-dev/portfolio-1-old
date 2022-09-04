<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Events\Order as OrderEvent;

class Order extends Component
{
    public $user;
    public $items;
    public $payment;

    public function mount()
    {
        if (session()->missing('items')) {
            return redirect()->route('cart');
        }
        $this->user    = Auth::user();
        $this->items   = session('items');
        $this->payment = 'クレジットカード';
    }

    public function updatedPayment()
    {
        $this->items = session('items');
    }

    public function render()
    {
        return view('livewire.order')
            ->extends('layouts.template')
            ->section('content');
    }

    public function complete()
    {
        $order_id = DB::table('orders')
            ->insertGetId([
                'user_id' => $this->user->id,
                'payment' => $this->payment,
            ]);

        foreach ($this->items as $item) {
            DB::table('order_details')
                ->insert([
                    'order_id'   => $order_id,
                    'product_id' => $item->id,
                    'quantity'   => $item->qty,
                ]);

            DB::table('products')
                ->where('id', $item->id)
                ->update([
                    'stock' => $item->stock - $item->qty,
                ]);
        }

        OrderEvent::dispatch($this->user, $this->items, $this->payment);

        session()->forget('items');

        return redirect()->route('order.history')
            ->with('status', __('messages.complete.order'));
    }
}
