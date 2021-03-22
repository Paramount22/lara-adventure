<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Tag can belongs to many dudes
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function dudes()
    {
        return $this->belongsToMany('App\Dude');
    }
}
