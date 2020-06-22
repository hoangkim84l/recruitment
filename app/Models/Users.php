<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	public $timestamps = false;
    protected $fillable = [
		'id',
        // add all other fields
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'users';
    public function scouters()
    {
        return $this->belongsTo('App\Models\Scouters','id','member_id');
    }
    //create foreign key with table Companies
  public function companies()
  {
    return $this->belongsTo('App\Models\Companies','id','member_id');
    }
 
}
