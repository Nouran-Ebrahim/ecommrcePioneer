<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::truncate();
        Page::create([
            'title' => [
                'en' => 'Terms & Conditions',
                'ar' => 'شروط والاحكام'
            ],
            'slug'=>'terms-conditions',
            'content' => [
                'en' => 'Terms & Conditions short description',
                'ar' => 'وصف قصير للشروط والاحكام'
            ]
        ]);

        Page::create([
            'title' => [
                'en' => 'Privacy Policy',
                'ar' => 'سياسية الخصوصية'
            ],
            'slug'=> 'privacy-policy',
            'content' => [
                'en' => 'Privacy Policy short description',
                'ar' => 'سياسية الخصصويه قصيره'
            ]
        ]);


    }
}
