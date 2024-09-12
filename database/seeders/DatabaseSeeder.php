<?php

namespace Database\Seeders;

use App\v1\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PetTypesTable::class);
        $this->call(PetSubTypesTable::class);
        $this->call(PetsTableSeeder::class);
    }
}
