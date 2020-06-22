<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
  public $timestamps = false;
	protected $fillable = [
		'id'
		// add all other fields
	];
	
	protected $table = 'friends';
  //create relationship with table users
}
