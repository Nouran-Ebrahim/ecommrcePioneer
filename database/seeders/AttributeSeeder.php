<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // to remove FOREIGN_KEY_CHECKS
        Attribute::truncate(); // to truncate table when i run the seeder agian as there is coloumn unque
        AttributeValue::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // to add FOREIGN_KEY

        $size_attribute = Attribute::create([
            'name' => [
                'en' => 'Size',
                'ar' => 'حجم'
            ],
        ]);

        $size_attribute->attributeValues()->createMany([
            [
                'value' => [
                    'en' => 'Small',
                    'ar' => 'صغير'
                ]
            ],
            [
                'value' => [
                    'en' => 'Medium',
                    'ar' => 'متوسط'
                ]
            ],
            [
                'value' => [
                    'en' => 'Large',
                    'ar' => 'كبير'
                ]
            ],
        ]);


        $color_attribute = Attribute::create([
            'name' => [
                'en' => 'Color',
                'ar' => 'اللون'
            ],
        ]);

        $color_attribute->attributeValues()->createMany([
            [
                'value' => [
                    'en' => 'Red',
                    'ar' => 'احمر'
                ]
            ],
            [
                'value' => [
                    'en' => 'Blue',
                    'ar' => 'ازرق'
                ]
            ],
            [
                'value' => [
                    'en' => 'Black',
                    'ar' => 'اسود'
                ]
            ],
            [
                'value' => [
                    'en' => 'Green',
                    'ar' => 'اخضر'
                ]
            ],
        ]);

    }
}
