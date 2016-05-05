<?php

namespace Modules\Game\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Game\Entities\ItemTemplate;

class ImagePosition extends Model
{
    public function itemTemplate(){
        $this->belongsTo(ItemTemplate::class);
    }
}
