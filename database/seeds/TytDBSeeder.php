<?php

use Illuminate\Database\Seeder;

class TytDBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category')->insert([
                'uri' => 'default',
                'name' => '默认分类',
                'pic' => ''
            ]

        );
    }
}
