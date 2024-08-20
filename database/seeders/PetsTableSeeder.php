<?php

namespace Database\Seeders;

use App\v1\Models\Pet;
use App\v1\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Factory::create();

        User::all()->each(function ($user) use ($faker) {
            foreach (range(1, 5) as $i) {
                Pet::create([
                    'user_id' => $user->id,
                    'nickname'   => $faker->word,
                    'about' => $faker->paragraphs(3, true),
                ]);
            }
        });
    }
}
