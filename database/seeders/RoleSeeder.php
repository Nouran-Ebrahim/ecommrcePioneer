<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $permessions = [];
        foreach(config('permessions_en') as $permession=>$value){
            $permessions[] = $permession;
        }

        Role::create([
            'role'=>[
                'ar'=>'مدير',
                'en'=>'Manger',
            ],
            'permessions'=>json_encode($permessions),
        ]);
    }
}
