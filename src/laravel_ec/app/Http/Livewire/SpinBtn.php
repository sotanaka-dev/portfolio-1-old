<?php

namespace App\Http\Livewire;

use Livewire\Component;


class SpinBtn extends Component
{
    public $max_value;
    public $value;


    public function render()
    {
        return view('livewire.spin-btn');
    }

    public function increment()
    {
        if ($this->value < $this->max_value) {
            $this->value++;
        }
    }

    public function decrement()
    {
        if ($this->value > 1) {
            $this->value--;
        }
    }
}