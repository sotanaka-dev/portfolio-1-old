@section('title', 'ProductDetail')

<div class="detail container-mid">
    <script>
        document.addEventListener('livewire:load', () => {
            document.getElementsByClassName('detail__thumbnail')[@this.thumbnail_index]
                .classList.add('detail__thumbnail--select')
        })
    </script>

    <div class="detail__images">
        <div class="detail__main-image-wrap">
            <img class="detail__main-image image" src="{{ asset($main_image_path) }}">

            <span class="detail__fav-wrap">
                @livewire('fav.icon', ['product' => $product])
            </span>

            <span class="detail__image-replacement detail__image-replacement--prev fa-stack"
                wire:click="decrementThumbnailIndex">
                <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa-solid fa-angle-left fa-stack-1x"></i>
            </span>

            <span class="detail__image-replacement detail__image-replacement--next fa-stack"
                wire:click="incrementThumbnailIndex">
                <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa-solid fa-angle-right fa-stack-1x"></i>
            </span>
        </div>

        <div class="detail__thumbnail-wrap">
            @foreach ($image_paths as $path)
                <img class="detail__thumbnail" src="{{ asset($path) }}"
                    wire:click="setThumbnailIndex({{ $loop->index }})">
            @endforeach
        </div>
    </div>

    <div class="detail__info-group">
        <p class="detail__name">{{ $product->name }}</p>
        <p class="detail__price">&yen;{{ number_format($product->price) }}</p>
        <p class="detail__category-name">Category:&nbsp;{{ $category_name }}</p>
        <p class="detail__sentence">{{ $product->description }}</p>

        @if ($product->stock >= 1)
            @if ($product->stock > 10)
                <p class="detail__stock-status text-success">
                    <i class="fa-solid fa-check"></i>&nbsp;在庫あり
                </p>
            @else
                <p class="detail__stock-status text-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;残り{{ $product->stock }}点
                </p>
            @endif

            <div class="detail__spin-btn">
                @livewire('components.spin-btn', ['max_value' => $product->stock, 'value' => 1])
            </div>

            <button class="btn btn--lg btn--black" type="submit" onclick="document.getElementById('form').submit();">
                カートに追加
            </button>
        @else
            <p class="detail__stock-status text-danger">
                <i class="fa-solid fa-xmark"></i>&nbsp;在庫なし
            </p>
        @endif

        <form id="form" action="{{ route('cart') }}" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="price" value="{{ $product->price }}">
            <input type="hidden" name="stock" value="{{ $product->stock }}">
            <input type="hidden" name="path" value="{{ $product->path }}">
        </form>
    </div>
</div>


{{-- @php
    $paths = glob($product->path . '*.*');
    asort($paths);
    dump(current($paths));
@endphp --}}
