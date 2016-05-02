<?php

namespace Modules\Character\Repositories;

use Modules\Character\Entities\Character;

class EffectRepository {

    /**
     * Get all characters that belong to a user
     *
     * @param Character $character
     * @return mixed
     */
    public function forCharacter(Character $character){
        return Character::where('character_id', $character->id)->get();
    }

}