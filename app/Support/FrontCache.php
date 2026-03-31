<?php

namespace App\Support;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
class FrontCache
{
    public const TTL_MINUTES = 30;

    public static function remember(array|string $tags, string $key, Closure $callback, ?int $ttlMinutes = null): mixed
    {
        $store = self::store();

        if (! $store) {
            return $callback();
        }

        return $store
            ->tags(self::normalizeTags($tags))
            ->remember($key, now()->addMinutes($ttlMinutes ?? self::TTL_MINUTES), $callback);
    }

    public static function flush(array|string $tags): void
    {
        $store = self::store();

        if (! $store) {
            return;
        }

        $store
            ->tags(self::normalizeTags($tags))
            ->flush();
    }

    public static function pages()
    {
        return self::remember(
            ['front.shared', 'front.pages'],
            'front:pages',
            fn() => Page::select('id', 'slug', 'title')->get()
        );
    }

    public static function rootCategories()
    {
        return self::remember(
            ['front.shared', 'front.categories'],
            'front:categories:root',
            fn() => Category::select('id', 'parent_id', 'slug', 'name')
                ->whereNull('parent_id')
                ->with(['children:id,parent_id,slug,name'])
                ->get()
        );
    }

    public static function headerCategories()
    {
        return self::remember(
            ['front.shared', 'front.categories'],
            'front:categories:header',
            fn() => Category::select( 'name')
                ->whereNull('parent_id')
                ->with(['children:id,parent_id,slug,name'])
                ->limit(4)
                ->get()
        );
    }

    public static function sliders()
    {
        return self::remember(
            ['front.shared', 'front.sliders'],
            'front:sliders',
            fn() => Slider::select('id', 'note', 'file_name')->get()
        );
    }

    public static function homeData(): array
    {
        return [
            'products' => self::homeLatestProducts(),
            'brands' => self::homeBrands(),
            'saleProducts' => self::homeSaleProducts(),
            'flasSaleProducts' => self::homeFlashSaleProducts(),
            'topSellingProducts' => self::homeBestSellingProducts(),
            'topSellingProductsInWeek' => self::homeBestSellingProductsWeekly(),
        ];
    }

    public static function homeLatestProducts()
    {
        return self::remember(
            ['front.home', 'front.products'],
            'front:home:latest-products',
            fn() => self::homeProductCardsQuery()->orderByDesc('products.created_at')->limit(8)->get()
        );
    }

    public static function homeBrands()
    {
        return self::remember(
            ['front.home', 'front.brands'],
            'front:home:brands',
            fn() => Brand::select('id', 'slug', 'name', 'logo')->limit(12)->get()
        );
    }

    public static function homeSaleProducts()
    {
        return self::remember(
            ['front.home', 'front.products'],
            'front:home:sale-products',
            fn() => self::homeProductCardsQuery()->where('products.has_discount', 1)->limit(12)->get()
        );
    }

    public static function homeFlashSaleProducts()
    {
        $today = now()->toDateString();

        return self::remember(
            ['front.home', 'front.products'],
            "front:home:flash-sale-products:{$today}",
            fn() => self::homeProductCardsQuery()
                ->where('products.has_discount', 1)
                ->whereDate('products.available_for', $today)
                ->get()
        );
    }

    public static function homeBestSellingProducts()
    {
        return self::remember(
            ['front.home', 'front.products', 'front.orders'],
            'front:home:products:best-selling',
            function () {
                $totals = DB::table('order_items')
                    ->join('orders', 'orders.id', '=', 'order_items.order_id')
                    ->where('orders.status', 'delivered')
                    ->groupBy('order_items.product_id')
                    ->selectRaw('order_items.product_id, SUM(order_items.quantity) as total_quantity');

                return self::homeProductCardsQuery()
                    ->joinSub($totals, 'sales_totals', function ($join) {
                        $join->on('sales_totals.product_id', '=', 'products.id');
                    })
                    ->addSelect('sales_totals.total_quantity')
                    ->orderByDesc('sales_totals.total_quantity')
                    ->limit(10)
                    ->get();
            }
        );
    }

    public static function homeBestSellingProductsWeekly()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weekKey = $startOfWeek->format('Y-m-d');

        return self::remember(
            ['front.home', 'front.products', 'front.orders'],
            "front:home:products:best-selling-weekly:{$weekKey}",
            function () use ($startOfWeek, $endOfWeek) {
                $totals = DB::table('order_items')
                    ->join('orders', 'orders.id', '=', 'order_items.order_id')
                    ->where('orders.status', 'delivered')
                    ->whereBetween('orders.created_at', [$startOfWeek, $endOfWeek])
                    ->groupBy('order_items.product_id')
                    ->selectRaw('order_items.product_id, SUM(order_items.quantity) as total_quantity');

                return self::homeProductCardsQuery()
                    ->joinSub($totals, 'weekly_sales_totals', function ($join) {
                        $join->on('weekly_sales_totals.product_id', '=', 'products.id');
                    })
                    ->addSelect('weekly_sales_totals.total_quantity')
                    ->orderByDesc('weekly_sales_totals.total_quantity')
                    ->limit(10)
                    ->get();
            }
        );
    }

    public static function allCategories()
    {
        return self::remember(
            ['front.categories'],
            'front:categories:all',
            fn() => Category::select('id', 'slug', 'name', 'parent_id')->get()
        );
    }

    public static function allBrands()
    {
        return self::remember(
            ['front.brands'],
            'front:brands:all',
            fn() => Brand::select('id', 'slug', 'name', 'logo')->get()
        );
    }

    public static function faqs()
    {
        return self::remember(['front.faqs'], 'front:faqs', fn() => Faq::get());
    }

    public static function pageBySlug(string $slug)
    {
        return self::remember(
            ['front.pages'],
            "front:page:{$slug}",
            fn() => Page::where('slug', $slug)->firstOrFail()
        );
    }

    public static function productsByCategorySlug(string $slug)
    {
        return self::remember(
            ['front.products', 'front.categories'],
            "front:products:category:{$slug}",
            function () use ($slug) {
                $category = Category::where('slug', $slug)->firstOrFail();

                return self::productCardQuery()
                    ->where('category_id', $category->id)
                    ->get();
            }
        );
    }

    public static function productsByBrandSlug(string $slug)
    {
        return self::remember(
            ['front.products', 'front.brands'],
            "front:products:brand:{$slug}",
            function () use ($slug) {
                $brand = Brand::where('slug', $slug)->firstOrFail();

                return self::productCardQuery()
                    ->where('brand_id', $brand->id)
                    ->get();
            }
        );
    }

    public static function arrivalProducts()
    {
        return self::remember(
            ['front.products'],
            'front:products:arrival',
            fn() => self::productCardQuery()->latest()->get()
        );
    }

    public static function flashProducts()
    {
        return self::remember(
            ['front.products'],
            'front:products:flash',
            fn() => self::productCardQuery()->latest()->where('has_discount', 1)->get()
        );
    }

    public static function flashTimerProducts()
    {
        $today = now()->toDateString();

        return self::remember(
            ['front.products'],
            "front:products:flash-timer:{$today}",
            fn() => self::productCardQuery()
                ->where('has_discount', 1)
                ->where('available_for', $today)
                ->get()
        );
    }

    public static function productDetailsBySlug(string $slug)
    {
        return self::remember(
            ['front.products'],
            "front:product-details:{$slug}",
            fn() => Product::where('slug', $slug)
                ->select([
                    'id',
                    'slug',
                    'sku',
                    'name',
                    'small_desc',
                    'desc',
                    'price',
                    'discount',
                    'has_discount',
                    'has_variants',
                    'quantity',
                    'category_id',
                    'brand_id',
                ])
                ->with([
                    'images:id,product_id,file_name',
                    'category:id,slug,name',
                    'tags:id,product_id,tag_name',
                    'reviews:id,product_id,user_id,comment,created_at',
                    'reviews.user:id,name,country_id,governorate_id',
                    'reviews.user.country:id,name',
                    'reviews.user.governorate:id,name',
                    'product_variants:id,product_id,price,stock',
                    'product_variants.product_attributes:id,product_variant_id,attribute_value_id',
                    'product_variants.product_attributes.attr_value:id,attr_id,value',
                    'product_variants.product_attributes.attr_value.attribute:id,name',
                ])
                ->firstOrFail()
        );
    }

    public static function sameProductsByCategoryId(int $categoryId)
    {
        return self::remember(
            ['front.products', 'front.categories'],
            "front:products:same-category:{$categoryId}",
            fn() => self::homeProductCardsQuery()
                ->where('products.category_id', $categoryId)
                ->limit(4)
                ->get()
        );
    }

    public static function bestSellingProducts()
    {
        return self::remember(
            ['front.products', 'front.orders'],
            'front:products:best-selling',
            function () {
                return self::productCardQuery()
                    ->withSum([
                    'ordersItems as total_quantity' => function ($query) {
                        $query->whereHas('order', function ($q) {
                            $q->where('status', 'delivered');
                        });
                    },
                ], 'quantity')
                    ->having('total_quantity', '>', 0)
                    ->orderByDesc('total_quantity')
                    ->take(10)
                    ->get();
            }
        );
    }

    public static function bestSellingProductsWeekly()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $weekKey = $startOfWeek->format('Y-m-d');

        return self::remember(
            ['front.products', 'front.orders'],
            "front:products:best-selling-weekly:{$weekKey}",
            function () use ($startOfWeek, $endOfWeek) {
                return self::productCardQuery()
                    ->withSum([
                    'ordersItems as total_quantity' => function ($query) use ($startOfWeek, $endOfWeek) {
                        $query->whereHas('order', function ($q) use ($startOfWeek, $endOfWeek) {
                            $q->where('status', 'delivered')
                                ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                        });
                    },
                ], 'quantity')
                    ->having('total_quantity', '>', 0)
                    ->orderByDesc('total_quantity')
                    ->take(10)
                    ->get();
            }
        );
    }

    protected static function productCardQuery(): Builder
    {
        return Product::query()
            ->select([
                'id',
                'slug',
                'name',
                'price',
                'discount',
                'has_discount',
                'has_variants',
                'available_for',
                'brand_id',
                'category_id',
                'created_at',
            ])
            ->with([
                'images:id,product_id,file_name',
                'brand:id,slug,name,logo',
                'category:id,slug,name',
            ]);
    }

    protected static function homeProductCardsQuery()
    {
        $firstImages = DB::table('product_images')
            ->selectRaw('MIN(id) as id, product_id')
            ->groupBy('product_id');

        return DB::table('products')
            ->leftJoinSub($firstImages, 'first_product_images', function ($join) {
                $join->on('first_product_images.product_id', '=', 'products.id');
            })
            ->leftJoin('product_images as first_image', 'first_image.id', '=', 'first_product_images.id')
            ->leftJoin('brands', function ($join) {
                $join->on('brands.id', '=', 'products.brand_id')
                    ->whereNull('brands.deleted_at');
            })
            ->leftJoin('categories', function ($join) {
                $join->on('categories.id', '=', 'products.category_id')
                    ->whereNull('categories.deleted_at');
            })
            ->select([
                'products.id',
                'products.slug',
                'products.name',
                'products.price',
                'products.discount',
                'products.has_discount',
                'products.has_variants',
                'products.available_for',
                'products.created_at',
                'categories.slug as category_slug',
                'categories.name as category_name',
                'brands.name as brand_name',
                'first_image.file_name as image_file_name',
            ]);
    }

    protected static function normalizeTags(array|string $tags): array
    {
        return array_values(array_unique(array_merge(['front'], (array) $tags)));
    }

    protected static function store(): ?Repository
    {
        if (class_exists(Redis::class) || class_exists(\Predis\Client::class)) {
            return Cache::store('redis');
        }

        return null;
    }
}
