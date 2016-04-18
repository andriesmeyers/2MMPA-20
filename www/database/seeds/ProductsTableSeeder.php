<?php

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, DatabaseSeeder::AMOUNT['MANY'])->create();
            // Voor elk van de gecreerde posts wordt een tag toegewezen.
            // use $tags -> de functie hieronder kan anders niet aan
            //  de variabele $tags(scope)



    }
}
