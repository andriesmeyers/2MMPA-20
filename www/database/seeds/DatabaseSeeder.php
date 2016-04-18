<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const AMOUNT = [
        'MIN' => 0,
        'FEW' => 3,
        'DEFAULT' => 10,
        'MANY' => 100,
        'MAX' => 1000,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeders = [
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
        ];

        $i = 0;
        foreach ($seeders as $seeder) {
            $count = sprintf('%02d', ++$i); // sprint if fuction -- %02d -> wil zeggen getal van twee cijfers. Als het minder dan 2 is wordt de prefix 0. bv 01 of 02
            // zowel "${count}" als "{$count}" mag. Maar liever eerste!
            $this->command->getOutput()->writeln("<comment>Seed ${count}:</comment> ${seeder}..."); // Count tonen
            $this->call($seeder);
        }
    }
}
