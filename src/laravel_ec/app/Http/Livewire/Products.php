<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class Products extends Component
{
    use WithPagination;

    public    $category_id = 0;
    public    $keyword     = '';
    public    $sort_by     = 'created_at,desc';
    protected $queryString = [
        'category_id' => ['except' => 0],
        'keyword'     => ['except' => ''],
        'sort_by'
    ];

    public function updatingSortBy()
    {
        $this->resetPage();
        $this->dispatchBrowserEvent('sort_by');
    }

    public function updatingKeyword()
    {
        $this->resetPage();
    }

    public function updatingCategoryId()
    {
        $this->resetPage();
    }

    public function updatedPage()
    {
        $this->dispatchBrowserEvent('page_switching');
    }

    public function render()
    {
        return view('livewire.products.index', [
            'products'        => $this->getProducts(),
            'categories'      => $this->getCategories(),
            'select_category' => $this->getSelectCategory(),
        ])
            ->extends('layouts.template')
            ->section('content');
    }

    private function getProducts()
    {
        return
            Product::when($this->category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when($this->keyword, function ($query, $keyword) {
                return $query->where('name', 'like', "%{$keyword}%");
            })
            ->orderBy(explode(",", $this->sort_by)[0], explode(",", $this->sort_by)[1])
            ->paginate(12);
    }

    private function getCategories()
    {
        return
            DB::table('categories')->get();
    }

    private function getSelectCategory()
    {
        if ($this->category_id) {
            return
                DB::table('categories')
                ->select('name')
                ->where('id', $this->category_id)
                ->value('name');
        }
        return 'ALL';
    }
}