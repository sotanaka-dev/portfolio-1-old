<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductDetail extends Component
{
    public $product_id;
    public $product;
    public $category_name;
    public $image_paths;
    public $max_length;
    public $main_image_path;
    public $thumbnail_index;

    public function mount(Request $request)
    {
        if (!$request->has('id')) {
            return redirect()->route('products');
        }

        $this->product_id      = $request->get('id');
        $this->product         = $this->getProduct();
        $this->category_name   = $this->getCategoryName();
        $this->image_paths     = glob($this->product->path . '*.*');
        $this->max_length      = count($this->image_paths) - 1;
        $this->main_image_path = current($this->image_paths);
        $this->thumbnail_index = 0;
    }

    public function render()
    {
        return view('livewire.product-detail')
            ->extends('layouts.template')
            ->section('content');
    }

    public function setThumbnailIndex($index)
    {
        $this->thumbnail_index = $index;
        $this->replacementMainImage();
    }

    public function decrementThumbnailIndex()
    {
        if ($this->thumbnail_index === 0) {
            $this->thumbnail_index = $this->max_length;
        } else {
            $this->thumbnail_index--;
        }

        $this->replacementMainImage();
    }

    public function incrementThumbnailIndex()
    {
        if ($this->thumbnail_index === $this->max_length) {
            $this->thumbnail_index = 0;
        } else {
            $this->thumbnail_index++;
        }

        $this->replacementMainImage();
    }

    private function getProduct()
    {
        return
            Product
            ::where('id', $this->product_id)
            ->first();
    }

    private function getCategoryName()
    {
        return
            DB::table('categories')
            ->select('name')
            ->where('id', $this->product->category_id)
            ->value('name');
    }

    private function replacementMainImage()
    {
        $this->main_image_path = $this->image_paths[$this->thumbnail_index];
        $this->dispatchBrowserEvent('select_thumbnail', ['id' => $this->thumbnail_index]);
    }
}
