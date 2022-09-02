<div class="cart__delete-wrap">
    <button class="speech-balloon-trigger" wire:click="deleteItem({{ $item->id }})">
        <i class="fa-solid fa-trash-can fa-lg"></i>
    </button>

    <span class="cart__speech-balloon speech-balloon speech-balloon--left">お気に入りから削除</span>
</div>
