<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'mobili_gebruiker@arteveldehs.be',
            'name' => 'mobili_gebruiker',
            'password' => Hash::make('mobili_wachtwoord'),
            'given_name' => 'Mobili',
            'family_name' => 'Gebruiker',
        ]);

        // Faker
        // -----
        factory(User::class, DatabaseSeeder::AMOUNT['DEFAULT'])->create();
    }
}
