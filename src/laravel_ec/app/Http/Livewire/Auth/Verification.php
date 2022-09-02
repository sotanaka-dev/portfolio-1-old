<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

class Verification extends Component
{
    public function render()
    {
        return view('livewire.auth.verification', ['email' => Auth::user()->email])
            ->extends('layouts.template')
            ->section('content');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('home')
            ->with('status', __('messages.complete.register'));
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', __('messages.complete.send_mail'));
    }
}