<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Character\Entities\Character;

class CharacterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if a user can delete a character
     *
     * @param User $user
     * @param Character $character
     * @return bool
     */
    public function destroy(User $user, Character $character){
        return ($user->id === $character->user_id);
    }
}
