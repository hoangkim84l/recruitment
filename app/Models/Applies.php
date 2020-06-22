<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applies extends Model
{
    public $timestamps = false;
    protected $fillable = [
      'id'
		        // add all other fields
  ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = 'applies';
    //create foreign key with table candidates
    public function candidates()
    {
        return $this->belongsTo('App\Models\Candidates','id');
    }
    //create foreign key with table scouters
    public function scouters()
    {
        return $this->belongsTo('App\Models\Scouters','id');
    }
    //create foreign key with table jobs
    public function jobs()
    {
        return $this->belongsTo('App\Models\Jobs','id');
    }
}
