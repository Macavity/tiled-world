<?php

namespace modules\Character\Entities;

use Illuminate\Database\Eloquent\Model;

define('EQUIP_FACE_1', 0);
define('EQUIP_FACE_2', 1);
define('EQUIP_GARMENT', 2);
define('EQUIP_ARMOUR', 3);
define('EQUIP_SHOES', 4);
define('EQUIP_RIGHT_HAND', 5);
define('EQUIP_LEFT_HAND', 6);
define('EQUIP_ACC_1', 7);
define('EQUIP_ACC_2', 8);
define('EQUIP_FACE_3', 9);

/**
 * Class EquipmentSet
 * @package modules\Character\Entities
 *
 * @property integer $face1;
 * @property integer $face2;
 * @property integer $face3;
 * @property integer $garment;
 * @property integer $armour;
 * @property integer $shoes;
 * @property integer $right_hand;
 * @property integer $left_hand;
 * @property integer $acc1;
 * @property integer $acc2;
 */
class EquipmentSet extends Model
{


}