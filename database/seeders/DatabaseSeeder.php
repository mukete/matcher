<?php

namespace Database\Seeders;

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
        factory(App\Models\Property::class, 20)->create();
        factory(App\Models\SearchProfile::class, 100)->create();
    }
}
