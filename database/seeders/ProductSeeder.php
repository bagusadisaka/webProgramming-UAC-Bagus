<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

require_once 'vendor/autoload.php';
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $location = ['Male','Female'];
        $merk = ['Swimming', 'Running', 'Football', 'Coding','Event Making','Badminton','Online Games','Travelling','Gem Collecting'];
        $chart = ['Yes','No'];
        $faker = Faker::create('id_ID');

        for ($i=0; $i < 100; $i++) {
            $test = Products::create([
                'Image' => "batik" . ($faker->numberBetween(1, 14)),
                'Location' => $location[$faker->numberBetween(0, 1)],
                'ProductName' => $faker->name(15),
                'CompanyProduct' => $merk[$faker->numberBetween(0, count($merk)-1)],
                'Color' => $faker->rgbCssColor(),
                'Rating' => $faker->numberBetween(1, 5),
                'Prices' => $faker->numberBetween(1000000, 50000000),
                'Chart' => $chart[$faker->numberBetween(0, 1)],
            ]);
        }
    }
}
