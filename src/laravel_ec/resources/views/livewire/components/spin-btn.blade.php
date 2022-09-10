<div class="spin-btn">
    <div class="spin-btn--minus" wire:click="decrement">
        <i class="fa-solid fa-minus fa-lg"></i>
    </div>
    <input class="form-input form-input--border-none" type="number" value="{{ $qty }}" min="1"
        max="{{ $upper_limit }}" required readonly />
    <div class="spin-btn--plus" wire:click="increment">
        <i class="fa-solid fa-plus fa-lg"></i>
    </div>
</div>
