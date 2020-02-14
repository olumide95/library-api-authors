<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid','name', 'gender','country',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'updated_at',
        'created_at',
    ];
}
