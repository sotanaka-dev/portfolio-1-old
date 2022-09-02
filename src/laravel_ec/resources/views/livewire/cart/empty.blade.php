@section('title', 'Cart')

<div class="container-sm">
    <p class="empty-item-message">カートにアイテムが入っていません。</p>

    <button class="btn btn--lg btn--black" onclick="location.href='{{ route('products') }}'">商品一覧へ</button>
</div>
