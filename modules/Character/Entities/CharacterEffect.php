<?php namespace Modules\Character\Entities;

use DB;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Character\Repositories\EffectRepository;

/**
 * Modules\Character\Entities\CharacterEffect
 *
 * @property integer $id
 * @property integer $character_id
 * @property integer $name
 * @property integer $type
 * @property integer $duration
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\Modules\Character\Entities\CharacterEffect whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Character\Entities\CharacterEffect whereCharacterId($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Character\Entities\CharacterEffect whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Character\Entities\CharacterEffect whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Character\Entities\CharacterEffect whereDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Character\Entities\CharacterEffect whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Modules\Character\Entities\CharacterEffect whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CharacterEffect extends Model
{

    protected $fillable = ["character_id", "name", "type", "duration"];

    public function character(){
        $this->belongsTo(Character::class);
    }
}
