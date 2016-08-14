<?php


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('category')->insert([
                'uri' => 'default',
                'name' => '默认分类',
                'pic' => ''
            ]

        );
        DB::table('siteconfig')->insert([
            'active' => true,
            'wspcode' => '',
            'live_update_time' => time(),
            'live_update_duration' => 60,
            'user_update_duration' => 60
        ]);
    }
}