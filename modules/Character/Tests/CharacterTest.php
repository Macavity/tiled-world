<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CharacterTest extends TestCase
{
    use DatabaseTransactions;

    public function testCharacterCreation() {
        factory(\Modules\Character\Entities\Character::class)->create([
            'name' => 'Blub'
        ]);

        $this->seeInDatabase('characters', [
            'name' => 'Blub'
        ]);
    }
}
