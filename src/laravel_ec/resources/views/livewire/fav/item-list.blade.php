@section('title', 'FavList')


{{-- TODO: refreshが効かないのはentangleを使ってることが原因みたいなので、entangleを使わないベストプラクティスを考える --}}

<div x-init="fav_items = JSON.parse(localStorage.getItem('fav_items') || '{}')" x-data="{ fav_items: @entangle('fav_items') }" class="fav-list  container-lg">

    <ul class="fav-list__items">
        @forelse ($fav_items as $fav_item)
            @livewire('fav.item', ['fav_item' => $fav_item], key($fav_item['id']))
        @empty
            <p x-cloak x-show="!Object.keys(fav_items).length" class="empty-item-message">
                <i class="fa-solid fa-xmark fa-lg"></i>&nbsp;お気に入りリストは空です。
            </p>

            <button x-cloak x-show="!Object.keys(fav_items).length" class="btn btn--lg btn--black"
                onclick="location.href='{{ route('products') }}'">
                商品一覧へ
            </button>
        @endforelse
    </ul>

</div>
