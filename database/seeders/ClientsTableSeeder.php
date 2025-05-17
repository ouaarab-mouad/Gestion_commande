<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use faker\Factory as Faker;


class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        for ($i = 0; $i < 30; $i++) {
            Client::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'telephone' => $faker->phoneNumber,
                'adresse' => $faker->address,
            ]);
        }
    }
}
