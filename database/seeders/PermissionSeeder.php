<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => [
                    'en' => 'Manage Categories',
                    'ar' => 'إدارة الفئات'
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Brands',
                    'ar' => "إدارة العلامات التجارية"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Coupons',
                    'ar' => "إدارة القسائم"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Products',
                    'ar' => "إدارة المنتجات"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Orders',
                    'ar' => "إدارة الطلبات"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Users',
                    'ar' => "إدارة المستخدمين"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Roles',
                    'ar' => "إدارة الأدوار"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Settings',
                    'ar' => "إدارة الإعدادات"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Reports',
                    'ar' => "إدارة التقارير"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Dashboard',
                    'ar' => "إدارة لوحة المعلومات"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Profile',
                    'ar' => "إدارة الملف الشخصي"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Home',
                    'ar' => "إدارة الصفحة الرئيسية"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Contact',
                    'ar' => "إدارة الاتصال"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage About',
                    'ar' => "إدارة صفحة من نحن"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Blog',
                    'ar' => "إدارة المدونة"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage News Letters',
                    'ar' => "إدارة رسائل الأخبار"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Banners',
                    'ar' => "إدارة اللافتات"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Sliders',
                    'ar' => "إدارة الشرائح"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Pages',
                    'ar' => "إدارة الصفح"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage FAQS',
                    'ar' => "إدارة الأسئلة الشائعة"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Comments',
                    'ar' => "إدارة التعليقات"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Socials',
                    'ar' => "إدارة وسائل التواصل الاجتماعي"
                ]
            ],
            [
                'name' => [
                    'en' => 'Manage Menus',
                    'ar' => "إدارة القوائم"
                ]
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'guard_name' => 'admin'  // أو القيمة المطلوبة للـ guard_name
            ]);
        }

    }
}
