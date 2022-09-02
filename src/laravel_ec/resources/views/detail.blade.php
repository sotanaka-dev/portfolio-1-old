{{-- NOTE: 使わない --}}

@extends('layouts.template')

@section('title', 'Detail')

@section('content')

    <div class="detail container-mid">
        {{-- @php
            $paths = glob($product->path . '*.*');
            asort($paths);
            dump(current($paths));
        @endphp --}}

        {{-- @foreach (glob($product->path . '*.*') as $path)
            <img src="{{ asset($path) }}" alt="">
        @endforeach --}}

        <style>
            .detail__main-image {
                margin-bottom: 12px;
            }

            .detail__sub-image-wrap {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
            }

            .detail__sub-image {
                width: calc(25% - 9px);
            }
        </style>

        <div class="detail__image">
            <span class="detail__fav-wrap">
                @livewire('fav', ['product' => $product])
            </span>

            <img class="detail__main-image image" src="{{ asset(current(glob($product->path . '*.*'))) }}" alt="">

            <div class="detail__sub-image-wrap">
                @foreach (glob($product->path . '*.*') as $path)
                    <img class="detail__sub-image" src="{{ asset($path) }}" alt="">
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
                    @livewire('spin-btn', ['max_value' => $product->stock, 'value' => 1])
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

@endsection
