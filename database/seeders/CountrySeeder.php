<?php

namespace Database\Seeders;

use App\Models\Country;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('countries')->truncate();
        $countries = [
            [
                "id" => "1",
                "name" => [
                    'ar' => "مصر",
                    'en' => "Egypt"
                ],
                "status" => 1,
                'phone_code' => '20'
            ],
        ];
        foreach ($countries as $key => $country) {
            Country::create($country);
        }

    }
}
