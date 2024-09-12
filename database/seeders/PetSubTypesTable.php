<?php

namespace Database\Seeders;

use App\v1\Models\PetSubType;
use App\v1\Models\PetType;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSubTypesTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        foreach (range(1, 50) as $i) {
            PetSubType::create([
                'type_id' => PetType::all()->random()->id,
                'title' => $faker->word,
            ]);
        }
    }
}
