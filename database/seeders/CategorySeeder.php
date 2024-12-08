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
        $data = [
            [
                'name' => ['en' => 'Electronics', 'ar' => 'الالكترونيات'],
                'status' => 1,
                'parent' => null
            ],
            [
                'name' => ['en' => 'Category2', 'ar' => 'التصنيف الثاني'],
                'status' => 1,
                'parent' => null
            ],
            [
                'name' => ['en' => 'Category3', 'ar' => 'التصيف الثالث'],
                'status' => 1,
                'parent' => null
            ],
            [
                'name' => ['en' => 'Category4', 'ar' => 'التصيف الرابع'],
                'status' => 1,
                'parent' => null
            ],

        ];
        foreach ($data as $key => $value) {
            Category::create($value);
        }
    }
}
