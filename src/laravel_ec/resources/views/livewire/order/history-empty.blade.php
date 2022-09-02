@section('title', 'OrderHistory')

<div class="container-sm">
    <p class="empty-item-message">注文履歴がありません。</p>

    <button class="btn btn--lg btn--black" onclick="location.href='{{ route('products') }}'">商品一覧へ</button>
</div>
