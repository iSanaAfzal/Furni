<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create The Admin user
        $newuser=User::Create([
         'name'=>'admin',
         'email'=>'admin@gmail.com',
         'password'=>Hash::make('password'),
 ]);
 $newuser->assignRole('admin');

    }
}