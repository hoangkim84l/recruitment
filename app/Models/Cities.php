<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
	public $timestamps = false;
	protected $fillable = [
		'id',
        // add all other fields
	];
	protected $table = 'cities';
  //create foreign key with table users
	public function scouters()
	{
		return $this->belongsTo('App\Models\scouters','id');
	}
	 //create foreign key with table jobs
     public function jobs()
     {
         return $this->belongsTo('App\Models\Jobs','id');
	 }
	 //create foreign key with table candidates
     public function candidates()
     {
         return $this->belongsTo('App\Models\Candidates','id');
     }
}
