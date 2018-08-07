<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App
 * @property integer id
 * @property string fullName
 * @property string password
 * @property string role
 * @property string api_token
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName',
        'email',
        'password',
        'role',
        'api_token',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param null $password
     * @return string
     */
    public function setPasswordAttribute($password = null)
    {
        return $this->attributes['password'] = bcrypt($password);
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return md5("{$this->fullName}.{$this->id}.{$this->created_at->toAtomString()}.{$this->password}");
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
