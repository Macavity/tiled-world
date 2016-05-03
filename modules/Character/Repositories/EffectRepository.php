<?php

namespace Modules\Character\Repositories;

use Modules\Character\Entities\Character;
use Modules\Character\Entities\CharacterEffect;

class EffectRepository {

    /**
     * Get all effects for the character
     * @param Character $character
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function forCharacter(Character $character){
        return CharacterEffect::where('character_id', $character->id)->get();
    }

    /**
     * Get only the effect names in an array, for the character
     * @param Character $character
     * @return array
     */
    public function effectListforCharacter(Character $character){
        $effectRows = CharacterEffect::where('character_id', $character->id)->get();
        $activeEffects = [];

        foreach($effectRows as $effectRow){
            array_push($activeEffects, $effectRow['name']);
        }
        return $activeEffects;
    }

}