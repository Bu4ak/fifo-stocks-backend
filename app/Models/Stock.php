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
 * @package App
 */
class Stock extends Model
{
    protected $hidden = ['user_id'];
    protected $casts = [
        'id' => 'string',
    ];
    public  $keyType = 'string';

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
