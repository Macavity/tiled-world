<?php

namespace Modules\Character;

use App\User;
use Modules\Character\Character;

class CharacterRepository {

    /**
     * Get all characters that belong to a user
     *
     * @param User $user
     * @return mixed
     */
    public function forUser(User $user){
        return Character::where('user_id', $user->id)
            ->orderBy('base_level', 'asc')
            ->get();
    }

}