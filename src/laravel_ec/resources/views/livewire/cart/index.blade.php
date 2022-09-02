@section('title', 'Cart')

<div class="cart container-sm">
    @foreach ($items as $item)
        <div class="cart__item">
            <a class="cart__item-image" href='{{ route('products.detail', ['id' => $item->id]) }}'>
                <img class="image" src="{{ asset(current(glob($item->path . '*.*'))) }}">
            </a>

            <div class="cart__info-group">
                <p class="cart__item-name">{{ $item->name }}</p>
                <p class="cart__item-price">&yen;{{ number_format($item->price) }}</p>

                <div class="form cart__form">
                    @include('livewire.cart.qty-update')

                    @include('livewire.cart.delete')
                </div>
            </div>
        </div>
    @endforeach

    @include('livewire.cart.total-amount')

    <button class=" btn btn--lg btn--black" onclick="location.href='{{ route('order.confirm') }}'">
        注文画面へ進む
    </button>
</div>
