<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class crud extends Model
{
    protected $table = 'crud';
    protected $fillable = [
        'id',
        'name',
        'gender',
        'age',
        'address',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
