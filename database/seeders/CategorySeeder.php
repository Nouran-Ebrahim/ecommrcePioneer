<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            [
                'name' => ['en' => 'Electronics', 'ar' => 'الالكترونيات'],
                'status' => 1,
                'parent' => null,
                'icon'=>'dresses.webp'
            ],
            [
                'name' => ['en' => 'Category2', 'ar' => 'التصنيف الثاني'],
                'status' => 1,
                'parent' => null,
                'icon'=>'dresses.webp'

            ],
            [
                'name' => ['en' => 'Category3', 'ar' => 'التصيف الثالث'],
                'status' => 1,
                'parent' => null,
                'icon'=>'dresses.webp'

            ],
            [
                'name' => ['en' => 'Category4', 'ar' => 'التصيف الرابع'],
                'status' => 1,
                'parent' => null,
                'icon'=>'dresses.webp'

            ],

        ];
        foreach ($data as $key => $value) {
            Category::create($value);
        }
    }
}
