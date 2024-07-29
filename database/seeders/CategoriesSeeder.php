<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 1,
            'name' => 'Sofa',
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Table',
        ]);

        Category::create([
            'id' => 3,
            'name' => 'Chair',
        ]);
    }
}