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
 * @property $lot_size
 */
class Stock extends Model
{
    public $keyType = 'string';
    protected $hidden = ['user_id'];
    protected $casts = [
        'id' => 'string',
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
