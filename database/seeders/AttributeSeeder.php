<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes=[
            [
                'name'=>[
                    'en'=>'size',
                    'ar'=>'الحجم'
                ]
            ],
            [
                'name'=>[
                    'en'=>'color',
                    'ar'=>'اللون'
                ]
            ]


        ];
        foreach ($attributes as $attribute) {
            Attribute::create([
             'name'=>$attribute['name']

            ]);
         }
    }
}
