<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'id',
        // add all other fields
	];
	protected $table = 'countries';
	//create foreign key with table companies
	public function companies()
	{
	  return $this->belongsTo('App\Models\companies','id');
	  }
}
