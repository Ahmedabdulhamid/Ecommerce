<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {




                // التصنيفات الرئيسية مع تصنيفات فرعية
                $categories = [
                    [
                        'name' => ['ar' => 'الإلكترونيات', 'en' => 'Electronics'],
                        'children' => [
                            ['name' => ['ar' => 'الهواتف', 'en' => 'Phones']],
                            ['name' => ['ar' => 'الكمبيوترات', 'en' => 'Computers']],
                        ],
                    ],
                    [
                        'name' => ['ar' => 'الأزياء', 'en' => 'Fashion'],
                        'children' => [
                            ['name' => ['ar' => 'ملابس رجالية', 'en' => 'Men Clothing']],
                            ['name' => ['ar' => 'ملابس نسائية', 'en' => 'Women Clothing']],
                        ],
                    ],
                    [
                        'name' => ['ar' => 'الأجهزة المنزلية', 'en' => 'Home Appliances'],
                        'children' => [
                            ['name' => ['ar' => 'أجهزة المطبخ', 'en' => 'Kitchen Appliances']],
                            ['name' => ['ar' => 'الأجهزة الكهربائية', 'en' => 'Electric Appliances']],
                        ],
                    ],
                    [
                        'name' => ['ar' => 'الصحة والجمال', 'en' => 'Health & Beauty'],
                        'children' => [
                            ['name' => ['ar' => 'مستحضرات التجميل', 'en' => 'Cosmetics']],
                            ['name' => ['ar' => 'منتجات العناية بالبشرة', 'en' => 'Skincare']],
                        ],
                    ],
                    [
                        'name' => ['ar' => 'الرياضة والترفيه', 'en' => 'Sports & Entertainment'],
                        'children' => [
                            ['name' => ['ar' => 'معدات اللياقة', 'en' => 'Fitness Equipment']],
                            ['name' => ['ar' => 'الألعاب الرياضية', 'en' => 'Sports Games']],
                        ],
                    ],
                    [
                        'name' => ['ar' => 'السيارات وملحقاتها', 'en' => 'Automobiles & Accessories'],
                        'children' => [
                            ['name' => ['ar' => 'إكسسوارات السيارات', 'en' => 'Car Accessories']],
                            ['name' => ['ar' => 'قطع الغيار', 'en' => 'Spare Parts']],
                        ],
                    ],
                    [
                        'name' => ['ar' => 'الألعاب والهوايات', 'en' => 'Toys & Hobbies'],
                        'children' => [
                            ['name' => ['ar' => 'ألعاب الأطفال', 'en' => 'Kids Toys']],
                            ['name' => ['ar' => 'ألعاب الفيديو', 'en' => 'Video Games']],
                        ],
                    ],
                    [
                        'name' => ['ar' => 'الكتب والمطبوعات', 'en' => 'Books & Publications'],
                        'children' => [
                            ['name' => ['ar' => 'الكتب العربية', 'en' => 'Arabic Books']],
                            ['name' => ['ar' => 'الكتب الإنجليزية', 'en' => 'English Books']],
                        ],
                    ],
                ];

                foreach ($categories as $categoryData) {
                    // إنشاء التصنيف الرئيسي
                    $category = Category::create([
                        'name' => $categoryData['name'],

                        'status' => 'active',
                    ]);

                    // إضافة التصنيفات الفرعية
                    if (!empty($categoryData['children'])) {
                        foreach ($categoryData['children'] as $subCategoryData) {
                            Category::create([
                                'name' => $subCategoryData['name'],

                                'parent_id' => $category->id,
                                'status' => 'active',
                            ]);
                        }
                    }
                }
            }
        }


