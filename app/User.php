<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'surname', 'phone', 'address', 'owner_id'];

    /**
     * The owner of this resource
     * @return \App\Admin  Owner
     */
    public function owner(){
    	return $this->belongsTo(\App\Admin::class, 'owner_id');
    }

}
