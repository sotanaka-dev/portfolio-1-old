<div class="spin-btn">
    <div class="spin-btn--minus" wire:click="decrement({{ $item->id }}, {{ $item->qty }})">
        <i class="fa-solid fa-minus fa-lg"></i>
    </div>
    <input class="form-input form-input--border-none" type="number" value="{{ $item->qty }}" min="1"
        max="{{ $item->stock }}" required readonly />
    <div class="spin-btn--plus" wire:click="increment({{ $item->id }}, {{ $item->qty }}, {{ $item->stock }})">
        <i class="fa-solid fa-plus fa-lg"></i>
    </div>
</div>
