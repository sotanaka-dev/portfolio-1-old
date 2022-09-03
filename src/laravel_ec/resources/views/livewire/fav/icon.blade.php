<span class="fav-icon">
    <script>
        /* NOTE: 初回のページ表示、リロードの際の処理（同期通信ではブラウザイベントを発行できない為） */
        document.addEventListener('livewire:load', () => {
            let id = @this.product_id
            let fav_add = 'fav_add_' + id
            let fav_rm = 'fav_rm_' + id

            stylingFavIcon(id, fav_add, fav_rm)
        })
    </script>

    <span class="fav-icon__add fav-icon--hide speech-balloon-trigger fa-stack" id="fav_add" wire:click="addToFav"
        wire:loading.remove>
        <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
        <i class="fa-solid fa-heart fa-stack-1x animated-hover faa-pulse"></i>
    </span>

    <span class="fav-icon__speech-balloon speech-balloon speech-balloon--right">お気に入りに追加</span>

    <span class="fav-icon__rm fav-icon--hide speech-balloon-trigger fa-stack" id="fav_rm" wire:click="rmFromFav"
        wire:loading.remove>
        <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
        <i class="fa-solid fa-heart fa-stack-1x animated-hover faa-pulse"></i>
    </span>

    <span class="fav-icon__speech-balloon speech-balloon speech-balloon--right">お気に入りから削除</span>

    <span class="fav-icon__load fa-stack" wire:loading>
        <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
        <i class="fa-solid fa-circle-notch fa-spin fa-stack-1x"></i>
    </span>
</span>
