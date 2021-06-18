<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'setting_name' => 'phone',
            'setting_value' => '+8801******41'
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'email',
            'setting_value' => 'admin@gmail.com'
        ]);
        DB::table('settings')->insert([
            'setting_name' => 'address',
            'setting_value' => '101,Dhanmondi,Dhaka'
        ]);
    }
}
