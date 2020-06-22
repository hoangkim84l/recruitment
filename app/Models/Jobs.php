<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    public $timestamps = false;
    protected $fillable = [
		'name',
		'bonus',
        'tags',
        'requirement',
        'description',
        'address',
        'address_city_id',
        // add all other fields
	];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'jobs';
    //create foreign key with table companies
    public function companies()
    {
        return $this->belongsTo('App\Models\Companies','id');
    }
     //create foreign key with table jobtypes
     public function jobtypes()
     {
         return $this->belongsTo('App\Models\Jobtypes','id');
     }
      //create foreign key with table cities
      public function cities()
      {
          return $this->belongsTo('App\Models\Cities','id');
      }
       //create foreign key with table applies
       public function applies()
       {
           return $this->belongsTo('App\Models\Applies','id');
       }
}
