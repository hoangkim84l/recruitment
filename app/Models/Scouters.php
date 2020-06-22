<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scouters extends Model
{
    public $timestamps = false;
	protected $fillable = [
        'id',
        'member_id',
		'address',
		'phone_number',
        'avatar_url'
        // add all other fields
	];
     protected $table = 'scouters';
    //create relationship with table users
    public function users()
    {
        return $this->belongsTo('App\Models\Users','id');
    }
    //create relationship with table applies
    public function applies()
    {
        return $this->belongsTo('App\Models\Applies','id');
    }
}
