<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPassword extends Component
{
    public $user;
    public $current_password;
    public $new_password;

    public function mount()
    {
        $this->user = Auth::user();
    }

    protected function rules()
    {
        return [
            'current_password' => ['required', 'current_password'],
            'new_password'     => ['required', 'min:8'],
        ];
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function render()
    {
        return view('livewire.auth.reset-password')
            ->extends('layouts.template')
            ->section('content');
    }

    public function resetPassword()
    {
        /*
        NOTE:
        パスワードを変更した際、変更した端末でもログアウトされてしまう
        TODO:
        livewireでうまくミドルウェアを呼び出す方法を探す（もしくはミドルウェアの実行タイミングを変える）
        */

        $this->dispatchBrowserEvent('before_validation');

        $validated_data = $this->validate();

        $this->user->password = Hash::make($validated_data['new_password']);
        $this->user->save();

        $this->reset(['current_password', 'new_password']);

        session()->flash('status', __('messages.complete.reset_password'));
    }
}