<?php

namespace App\Support;

use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Countary;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Order;
use App\Models\Page;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use App\Models\WebFaqQuestion;
use Closure;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class AdminCache
{
    public const TTL_MINUTES = 15;

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

    public static function sidebarCounts(): array
    {
        return self::remember(
            ['admin.sidebar'],
            'admin:sidebar:counts',
            fn () => [
                'products' => Product::count(),
                'users' => User::count(),
                'brands' => Brand::count(),
                'coupones' => Coupon::count(),
                'permissions' => Permission::count(),
                'roles' => Role::count(),
                'faqs' => Faq::count(),
                'categories' => Category::count(),
                'countaries' => Countary::count(),
                'attributesCount' => Attribute::count(),
                'settings' => Setting::count(),
                'admins' => Admin::count(),
                'contacts' => Contact::count(),
                'sliders' => Slider::count(),
                'pages' => Page::count(),
                'orders' => Order::count(),
                'userQuestions' => WebFaqQuestion::count(),
            ]
        );
    }

    protected static function normalizeTags(array|string $tags): array
    {
        return array_values(array_unique(array_merge(['admin'], (array) $tags)));
    }

    protected static function store(): ?Repository
    {
        if (class_exists(Redis::class) || class_exists(\Predis\Client::class)) {
            return Cache::store('redis');
        }

        return null;
    }
}
