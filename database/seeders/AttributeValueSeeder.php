<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attrValues=[
          ['value'=>'xx-large','attr_id'=>1],
          ['value'=>'x-large','attr_id'=>1],
          ['value'=>"mediun",'attr_id'=>1],
          ['value'=>'small','attr_id'=>1],
          ['value'=>'black','attr_id'=>2],
          ['value'=>'blue','attr_id'=>2],
          ['value'=>'red','attr_id'=>2],
          ['value'=>'green','attr_id'=>2],


        ];
        foreach ($attrValues as $value) {
           AttributeValue::create([
              'value'=>$value['value'],
              'attr_id'=>$value['attr_id']
           ]);
        }
    }
}
