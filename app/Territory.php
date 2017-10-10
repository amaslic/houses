<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Territory extends Model
{
     protected $fillable = [
        'color',
        'description',
        'ltdlng',
        //'user_id',

    ];
}
