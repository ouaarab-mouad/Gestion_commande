<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use faker\Factory as Faker;
use App\Models\Commande;

class CommandeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');
        for ($i = 0; $i < 30; $i++) {
            Commande::create([
                'client_id' => $faker->numberBetween(1, 30),
                'date_commande' => $faker->dateTimeBetween('-1 year', 'now'),
                'montant_total' => $faker->randomFloat(2, 10, 1000),
            ]);
        }
    }
}
