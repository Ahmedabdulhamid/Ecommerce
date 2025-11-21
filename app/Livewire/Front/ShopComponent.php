<?php



namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\WithoutUrlPagination;

class ShopComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';


    public $selectedCategories = [];
    public $minPrice, $maxPrice;

    public $categories, $brands;
    public array $categoryIds = [];
    public array $brandsIds = [];


    public $msg;

    public function mount()
    {
        $this->minPrice = 75;
        $this->maxPrice = 10000;
        $this->categories = Category::whereNotNull('parent_id')->has('products')->get();
        $this->brands = Brand::has('products')->get();
    }



    public function getFilteredProductsProperty()
    {
        return Product::with(['images', 'brand', 'category', 'product_variants'])
            ->when(
                !empty($this->categoryIds),
                fn($q) =>
                $q->whereIn('category_id', $this->categoryIds)
            )
            ->when(
                !empty($this->brandsIds),
                fn($q) =>
                $q->whereIn('brand_id', $this->brandsIds)
            )
            ->where(function ($q) {
                $q->where(function ($query) {
                    $query->where('has_discount', 0)
                        ->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                })
                    ->orWhere(function ($query) {
                        $query->where('has_discount', 1)
                            ->whereRaw('(price - discount) BETWEEN ? AND ?', [$this->minPrice, $this->maxPrice]);
                    })
                    ->orWhereRelation('product_variants', function ($query) {
                        $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
                    });
            })
            ->paginate(10);
    }

    public function render()
    {

        return view('livewire.front.shop-component', [
            'products' => $this->filteredProducts
        ]);
    }
}
