<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    public $timestamps = false;
   protected $fillable = [
		'name'
		        // add all other fields
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'candidates';
    public function applies()
    {
        return $this->belongsTo('App\Models\Applies','id');
    }
    //create foreign key with table cities
    public function cities()
    {
        return $this->belongsTo('App\Models\Cities','id');
    }
}
