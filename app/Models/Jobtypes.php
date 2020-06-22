<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Jobtypes extends Model
{
     public $timestamps = false;
	protected $fillable = [
		'id'
		        // add all other fields
	];
     protected $table = 'jobtypes';
	//create foreign key with table jobs
    public function jobs()
    {
        return $this->belongsTo('App\Models\Jobs','id');
    }
}
