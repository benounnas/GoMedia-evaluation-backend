<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            'first_name' => "Benounnas",
            'last_name' => "oussama",
            "email" => "benounnas.oussama@gmail.com",
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'first_name' => "go",
            'last_name' => "media",
            "email" => "mail@gomedia.com",
            'password' => Hash::make('password'),
        ]);
    }
}
