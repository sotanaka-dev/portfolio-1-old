<li class="fav-list__item link link-line" id="{{ $fav['id'] }}">
    <span class="fav-list__rm fa-stack speech-balloon-trigger" wire:click="rmFromFav">
        <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
        <i class="fa-solid fa-xmark fa-lg fa-stack-1x"></i>
    </span>

    <span class="fav-list__speech-balloon speech-balloon speech-balloon--right">お気に入りから削除</span>

    <span class="fav-list__loading" wire:loading>
        <i class="fa-solid fa-spinner fa-spin-pulse fa-xl"></i>
    </span>

    <a href="{{ route('products.detail', ['id' => $fav['id']]) }}">
        <img class="image" src="{{ asset(current(glob($fav['path'] . '*.*'))) }}">

        <p class="fav-list__name">
            {{ $fav['name'] }}
        </p>
    </a>
</li>
