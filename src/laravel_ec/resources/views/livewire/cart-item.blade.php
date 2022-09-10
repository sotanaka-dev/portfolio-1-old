<div class="cart__item">
    <a class="cart__item-image" href='{{ route('products.detail', ['id' => $item_id]) }}'>
        <img class="image" src="{{ asset(current(glob($path . '*.*'))) }}">
    </a>

    <div class="cart__info-group">
        <p class="cart__item-name">{{ $name }}</p>
        <p class="cart__item-price">&yen;{{ number_format($price) }}</p>

        <div class="form cart__form">
            <div class="spin-btn">
                <div class="spin-btn--minus" wire:click="decrement">
                    <i class="fa-solid fa-minus fa-lg"></i>
                </div>
                <input class="form-input form-input--border-none" type="number" value="{{ $qty }}"
                    min="1" max="{{ $stock }}" required readonly />
                <div class="spin-btn--plus" wire:click="increment">
                    <i class="fa-solid fa-plus fa-lg"></i>
                </div>
            </div>

            <div class="cart__remove-wrap">
                <button class="speech-balloon-trigger" wire:click="removeItem">
                    <i class="fa-solid fa-trash-can fa-lg"></i>
                </button>

                <span class="cart__speech-balloon speech-balloon speech-balloon--left">お気に入りから削除</span>
            </div>
        </div>
    </div>
</div>
