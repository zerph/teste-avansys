<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operadoras extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title', 'text'
    ];
    protected $dates = ['deleted_at'];
}
