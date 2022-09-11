<div class="detail__images">
    <script>
        document.addEventListener('livewire:load', () => {
            document.getElementsByClassName('detail__thumbnail')[@this.thumbnail_index]
                .classList.add('detail__thumbnail--select')
        })
    </script>

    <div class="detail__main-image-wrap">
        <img class="detail__main-image image" src="{{ asset($main_image_path) }}">

        <span class="detail__fav-wrap">
            @livewire('fav.icon', ['product' => $product])
        </span>

        <span class="detail__image-replacement detail__image-replacement--prev fa-stack"
            wire:click="decrementThumbnailIndex">
            <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
            <i class="fa-solid fa-angle-left fa-stack-1x"></i>
        </span>

        <span class="detail__image-replacement detail__image-replacement--next fa-stack"
            wire:click="incrementThumbnailIndex">
            <i class="fa-solid fa-circle fa-stack-2x fa-inverse"></i>
            <i class="fa-solid fa-angle-right fa-stack-1x"></i>
        </span>
    </div>

    <div class="detail__thumbnail-wrap">
        @foreach ($image_paths as $path)
            <img class="detail__thumbnail" src="{{ asset($path) }}"
                wire:click="setThumbnailIndex({{ $loop->index }})">
        @endforeach
    </div>
</div>
