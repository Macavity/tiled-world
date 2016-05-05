<?php

namespace Modules\Game\Entities;

use App\ImagePosition;
use Illuminate\Database\Eloquent\Model;

class ItemTemplate extends Model
{

    public function imagePosition(){
        $this->hasMany(ImagePosition::class);
    }


}
