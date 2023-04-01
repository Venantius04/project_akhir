<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

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
        Customer::factory(10)->create();
        Product::factory(10)->create();
        User::factory()->create([
            'name' => 'Venantius Wisnu',
            'email' => 'venantius@gmail.com',
            'password' => bcrypt('password'),
        ]);
    }
}
