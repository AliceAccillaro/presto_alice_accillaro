<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategoriesSeeder::class);
    }
}