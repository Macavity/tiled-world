<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        factory(\App\User::class, 50)->create()->each(function(\App\User $user){
            $user->characters()->save(factory(\Modules\Character\Entities\Character::class)->make());
        });
    }
}
