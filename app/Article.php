<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Article extends Model
{
    
    use HasTrixRichText;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    // mass assignable attributes->all
    protected $guarded = [];

    //---------------------------
    // RELATIONSHIPS
    //---------------------------

    //belongs to one user
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    //belongs to many Tags
    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
