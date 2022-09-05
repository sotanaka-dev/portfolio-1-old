@section('title', 'FavList')

<div class="fav-list  container-sm">
    <script>
        document.addEventListener('livewire:load', () => {
            let fav_list = JSON.parse(localStorage.getItem('fav_list'))

            if (fav_list && fav_list.length) {
                @this.fav_list = fav_list
            } else {
                insertFavEmptyMessage()
            }
        })
    </script>

    <p class="fav-list__heading" id="fav_list_heading"></p>

    <ul class="fav-list__items" id="fav_list_ul">
        @foreach ($fav_list as $fav)
            @livewire('fav.item', ['fav' => $fav])
        @endforeach
    </ul>

    <p class="fav-list__empty-item-message empty-item-message" id="fav_list_empty"><i
            class="fa-solid fa-xmark fa-lg"></i>&nbsp;お気に入りリストは空です。</p>

    <button class="fav-list__btn btn btn--lg btn--black" id="fav_list_btn"
        onclick="location.href='{{ route('products') }}'">商品一覧へ</button>
</div>
