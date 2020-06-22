<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'id'
		        // add all other fields
	];
     protected $table = 'tags';
    //create relationship with table users
}
