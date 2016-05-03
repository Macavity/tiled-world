<?php

namespace Modules\Character\Repositories;

use App\User;
use Modules\Character\Entities\Character;
use Modules\Character\Entities\EquipmentSet;

class EquipmentSetRepository {

    /**
     * Get all characters that belong to a user
     *
     * @param Character $character
     * @return mixed
     */
    public function forCharacter(Character $character){
        return EquipmentSet::where('character_id', $character->id)
            ->get();
    }

    /**
     * @param Character $character
     * @return EquipmentSet
     */
    public function active(Character $character){
        return EquipmentSet::find($character->equipment_set_id);
    }

}