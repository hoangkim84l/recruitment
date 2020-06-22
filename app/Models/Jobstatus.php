<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobstatus extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id'
    ];

    protected $table = 'jobstatus';
}
