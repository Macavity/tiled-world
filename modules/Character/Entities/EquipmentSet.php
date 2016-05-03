<?php

namespace Modules\Character\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EquipmentSet
 *
 * @package modules\Character\Entities
 * @property integer $id
 * @property integer $character_id
 * @property string $name
 * @property boolean $face1
 * @property boolean $face2
 * @property boolean $face3
 * @property boolean $garment
 * @property boolean $armour
 * @property boolean $shoes
 * @property boolean $right_hand
 * @property boolean $left_hand
 * @property boolean $acc1
 * @property boolean $acc2
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereCharacterId($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereFace1($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereFace2($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereFace3($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereGarment($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereArmour($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereShoes($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereRightHand($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereLeftHand($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereAcc1($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereAcc2($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\modules\Character\Entities\EquipmentSet whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EquipmentSet extends Model
{

    public function user(){
        $this->belongsTo(Character::class);
    }
}