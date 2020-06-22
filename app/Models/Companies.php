<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
  public $timestamps = false;
    protected $fillable = [
      'id',
        'member_id',
      'name',
        // add all other fields
  ];
  protected $table = 'companies';
  //create foreign key with table users
  public function users()
  {
    return $this->belongsTo('App\Models\users','id');
    }
    //create foreign key with table jobs
   public function jobs()
    {
        return $this->belongsTo('App\Models\jobs','id','company_id');
    }
    //create foreign key with table jobs
   public function countries()
   {
       return $this->belongsTo('App\Models\countries','id');
   }
}
