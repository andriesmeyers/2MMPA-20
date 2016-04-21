<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SeederTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->seeInDatabase(CreateUsersTable::TABLE, [
            'email' => 'mobili_gebruiker@arteveldehs.be',
            'name' => 'mobili_gebruiker',
            'given_name' => 'Mobili',
            'family_name' => 'Gebruiker',
        ]);
    }
}