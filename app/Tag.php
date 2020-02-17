<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
   
	// substitutes the id with the name of the model instance inside the route
   	public function getRouteKeyName()
	{
	    return 'name';
	}

	//---------------------------
    // RELATIONSHIPS
    //--------------------------- 

    // belongs to many articles
   	public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
