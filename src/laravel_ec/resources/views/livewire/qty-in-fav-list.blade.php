<span class="header__counter" id="qty_in_fav_list">
    <script>
        document.addEventListener('livewire:load', () => {
            let fav_list = JSON.parse(localStorage.getItem('fav_list'))

            if (fav_list && fav_list.length) {
                @this.qty = fav_list.length
            }
        })
    </script>

    {{ $qty }}
</span>
