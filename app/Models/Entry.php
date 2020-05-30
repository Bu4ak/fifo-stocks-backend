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
 */
class Entry extends Model
{
    public $keyType = 'string';
    protected $hidden = ['user_id'];
    protected $casts = [
        'id' => 'string',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
