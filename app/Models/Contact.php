<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @package App
 */
class Contact extends Model
{

    protected $fillable = [
        'fullName',
        'email',
        'message',
        'read'
    ];

}
