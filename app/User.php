<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

/**
 * Class User
 * @property $id
 * @property $password
 * @property $login
 * @property $token
 * @package App
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $casts = [
        'id' => 'string',
    ];

//    public $incrementing = false;

    protected $hidden = [
        'password',
    ];
}
