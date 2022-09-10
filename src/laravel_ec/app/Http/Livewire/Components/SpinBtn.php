<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;


class SpinBtn extends Component
{

    private const LOWER_LIMIT = 1;

    public $upper_limit;
    public $qty;

    public function render()
    {
        return view('livewire.components.spin-btn');
    }

    public function increment()
    {
        if ($this->qty < $this->upper_limit) {
            $this->qty++;
            $this->emitUp('set', 'qty', $this->qty);
        }
    }

    public function decrement()
    {
        if ($this->qty > self::LOWER_LIMIT) {
            $this->qty--;
            $this->emitUp('set', 'qty', $this->qty);
        }
    }
}
