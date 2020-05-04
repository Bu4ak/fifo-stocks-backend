<?php

namespace App\Models;

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
    protected $hidden = ['user_id'];
    protected $casts = [
        'id' => 'string',
    ];
}
