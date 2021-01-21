<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'username'=>'admin',
            'date-of-birth'=> now(),
            'email'=> 'admin@admin.com',
            'password'=>Hash::make('password'),
            'usertype'=>"admin"
        ]);
    }
}
