<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Traits\ResetEmailTrait;

class ResetEmail extends Component
{
    use ResetEmailTrait;

    public function render()
    {
        return view('livewire.auth.reset-email')
            ->extends('layouts.template')
            ->section('content');
    }
}