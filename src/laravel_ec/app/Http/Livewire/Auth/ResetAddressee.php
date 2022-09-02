<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Rules\PostalCodeRule;

class ResetAddressee extends Component
{
    public function mount()
    {
        $this->user        = Auth::user();
        $this->name        = $this->user->name;
        $this->postal_code = $this->user->postal_code;
        $this->address     = $this->user->address;
        $this->tel         = $this->user->tel;
    }

    protected function rules()
    {
        return [
            'name'        => ['required', 'max:255'],
            'postal_code' => ['required', new PostalCodeRule()],
            'address'     => ['required'],
            'tel'         => ['required', 'digits_between:10, 11'],
        ];
    }

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function updatedPostalCode()
    {
        $this->postal_code = \Util::grantHyphen($this->postal_code);
    }

    public function render()
    {
        return view('livewire.auth.reset-addressee')
            ->extends('layouts.template')
            ->section('content');;
    }

    public function resetUser()
    {
        $this->dispatchBrowserEvent('before_validation');

        $validated_data = $this->validate();
        $this->user->fill($validated_data)->save();

        session()->flash('status', __('messages.complete.reset_user'));
    }
}