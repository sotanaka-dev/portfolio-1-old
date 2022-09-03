@foreach ($products as $product)
    <div class="products-list__item link link-line">
        <span class="products-list__fav-wrap">
            @livewire('fav-icon', ['product' => $product], key($product->id))
        </span>

        @if ($product->stock <= 0)
            <span class="products-list__stock-status">SOLD<br>OUT</span>
        @endif

        <a href='{{ route('products.detail', ['id' => $product->id]) }}'>
            <img class="image" src="{{ asset(current(glob($product->path . '*.*'))) }}">

            <p class="products-list__excerpt">
                <span>{{ $product->name }}</span>
                <span>&yen;{{ number_format($product->price) }}</span>
            </p>
        </a>
    </div>

    {{-- NOTE: ページ切り替え、検索、並べ替えで商品ページが再レンダリングされる際の処理 --}}
    {{ $this->dispatchBrowserEvent('after_async_process', ['id' => $product->id]) }}
@endforeach
