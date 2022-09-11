<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SwitchProductImage extends Component
{
    private const START_VALUE_OF_INDEX = 0;
    private const DIFF_BTW_COUNT_AND_INDEX = 1;
    private const REGEX_FOR_ALL_FILES = '*.*';

    public $product;
    public $thumbnail_index = self::START_VALUE_OF_INDEX;

    public function mount()
    {
        $this->image_paths     = glob($this->product->path . self::REGEX_FOR_ALL_FILES);
        $this->max_length      = count($this->image_paths) - self::DIFF_BTW_COUNT_AND_INDEX;
        $this->main_image_path = current($this->image_paths);
    }

    public function render()
    {
        return view('livewire.components.switch-product-image');
    }

    public function setThumbnailIndex($index)
    {
        $this->thumbnail_index = $index;
        $this->replacementMainImage();
    }

    public function decrementThumbnailIndex()
    {
        if ($this->thumbnail_index === self::START_VALUE_OF_INDEX) {
            $this->thumbnail_index = $this->max_length;
        } else {
            $this->thumbnail_index--;
        }

        $this->replacementMainImage();
    }

    public function incrementThumbnailIndex()
    {
        if ($this->thumbnail_index === $this->max_length) {
            $this->thumbnail_index = self::START_VALUE_OF_INDEX;
        } else {
            $this->thumbnail_index++;
        }

        $this->replacementMainImage();
    }

    private function replacementMainImage()
    {
        $this->main_image_path = $this->image_paths[$this->thumbnail_index];
        $this->dispatchBrowserEvent('select_thumbnail', ['id' => $this->thumbnail_index]);
    }
}
