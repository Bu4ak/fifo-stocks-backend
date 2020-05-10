<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 *
 * @property $id
 * @property $amount
 * @property $count
 * @property $stock_id
 * @package App
 */
class Entry extends Model
{
    protected $hidden = ['user_id'];
    protected $casts = [
        'id' => 'string',
    ];
}
