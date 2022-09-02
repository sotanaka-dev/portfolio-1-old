@extends('layouts.template')

@section('title', 'Order')

@section('content')

    <div class="order container-sm">
        <div class="order__table table">
            <div class="table__row">
                <span class="table__cell">お名前</span>
                <span class="table__cell">{{ $user->name }}</span>
            </div>

            <div class="table__row">
                <span class="table__cell">お届け先住所</span>
                <span class="table__cell">&#12306;{{ $user->postal_code }}&nbsp;&nbsp;{{ $user->address }}</span>
            </div>

            <div class="table__row">
                <span class="table__cell">メールアドレス</span>
                <span class="table__cell">{{ $user->email }}</span>
            </div>

            <div class="table__row">
                <span class="table__cell">電話番号</span>
                <span class="table__cell">{{ $user->tel }}</span>
            </div>

            <div class="table__row">
                <span class="table__cell">ご請求金額</span>
                <span class="table__cell">&yen;{{ number_format($total_amount) }}&nbsp;&#40;税込&#41;</span>
            </div>
        </div>


        <form action="{{ route('order.complete') }}" method="post">
            @csrf

            <div class="order__select-payment select-payment">
                <label class="select-payment__item" for="credit">
                    <input type="radio" name="payment" id="credit" value="クレジットカード" checked>
                    クレジットカード
                </label>

                <label class="select-payment__item" for="convenience">
                    <input type="radio" name="payment" id="convenience" value="コンビニ決済">
                    コンビニ決済
                </label>

                <label class="select-payment__item" for="cash">
                    <input type="radio" name="payment" id="cash" value="代金引換">
                    代金引換
                </label>
            </div>

            <div class="split-btn">
                <div class="split-btn__return">
                    <button class="btn btn--lg btn--black" type="button"
                        onclick="location.href='{{ route('cart') }}'">カートに戻る</button>
                </div>

                <div class="split-btn__advance">
                    <button class="btn btn--lg btn--black" type="submit"
                        onclick="return confirmation('{{ __('messages.confirm.order') }}')">注文を確定する</button>
                </div>
            </div>
        </form>
    </div>
@endsection
