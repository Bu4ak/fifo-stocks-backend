<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property $id
 * @property $user_id
 * @property $name
 * @property $ticker
 * @package App
 */
class Stock extends Model
{
    protected $casts = [
        'id' => 'string',
    ];
//    public $incrementing = false;
}
