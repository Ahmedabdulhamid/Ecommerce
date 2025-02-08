<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins=[
          [
            'name'=>'admin2',
            "email"=>"admin@gmail.com",
           "password"=>'password',

          ],
          [
            'name'=>'Vendor',
            "email"=>"vendor@gmail.com",
           "password"=>'password',
          ],
          [
            'name'=>'Product Manager',
            "email"=>"product@gmail.com",
           "password"=>'password',
          ],
          [
            'name'=>'Order Manager',
            "email"=>"order@gmail.com",
           "password"=>'password',
          ],
          [
            'name'=>'Content Manager',
            "email"=>"content@gmail.com",
           "password"=>'password',
          ],
          [
            'name'=>'Marketing Manager',
            "email"=>"market@gmail.com",
           "password"=>'password',
          ],
          [
            'name'=>'Customer Support',
            "email"=>"customer@gmail.com",
           "password"=>'password',
          ],
          [
            'name'=>'Designer',
            "email"=>"design@gmail.com",
           "password"=>'password',
          ],

        ];
        foreach ($admins as $admin) {
            Admin::create([
                'name'=>$admin['name'],
                'email'=>$admin['email'],
                'password'=>bcrypt($admin['password'])
            ]);
            # code...
        }
    }
}
