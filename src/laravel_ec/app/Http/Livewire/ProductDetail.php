<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductDetail extends Component
{
    private const START_VALUE_OF_INDEX = 0;
    private const DIFF_BTW_COUNT_AND_INDEX = 1;
    private const REGEX_FOR_ALL_FILES = '*.*';

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
        $this->image_paths     = glob($this->product->path . self::REGEX_FOR_ALL_FILES);
        $this->max_length      = count($this->image_paths) - self::DIFF_BTW_COUNT_AND_INDEX;
        $this->main_image_path = current($this->image_paths);
        $this->thumbnail_index = self::START_VALUE_OF_INDEX;
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


    private const MIN_VALUE_OF_SPIN_BTN = 1;
    public $qty = self::MIN_VALUE_OF_SPIN_BTN;

    public function increment()
    {
        if ($this->qty < $this->product->stock) {
            $this->qty++;
        }
    }

    public function decrement()
    {
        if ($this->qty > self::MIN_VALUE_OF_SPIN_BTN) {
            $this->qty--;
        }
    }

    /* TODO: リファクタリングしたい */
    public function addProductToCart()
    {
        $items = \Util::getItemsInTheSession();

        if ($items->has($this->product_id)) {
            $items = $items->toArray();
            $items[$this->product_id]['qty'] += $this->qty;
        } else {
            $item = $this->product->toArray();
            $item['qty'] = $this->qty;
            $items->put($this->product_id, $item);
        }
        session()->put('items', collect($items));

        return redirect()->route('cart');
    }
}
