<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
	public function __construct(User $user)
	{	
		// middleware checks if current user is admin or auth user
		$this->middleware('check.if.admin.or.auth.user');

		// middleware checks if user is authenticated
		$this->middleware('auth');
    
	}

	//----------------------------------
    // CRUD
    //----------------------------------

	// shows auth users profile
    public function show(User $user)
    {
    	return view('profiles.show', ['user'=>$user]);
    }

    public function edit(User $user)
    {
    	return view('profiles.edit', ['user'=>$user]);
    }

    // updates the profile
    public function update(User $user)
    {	
    	$attributes = $this->validateAttributes();

    	$user->update($attributes);

    	return view('profiles.show', ['user'=>$user]);
    }

    // all articles created by user
    public function showArticles(User $user)
    {
    	$articles = Article::where('user_id', $user->id)->paginate(9);
    	return view('profiles.articles', ['articles'=> $articles]);
    }


    //----------------------------------
    // HELPERS
    //----------------------------------

    //server side validation
    public function validateAttributes()
    {	
        return request()->validate([
            'name'=> 'required',
            'email' => 'required',
            ]);
    }  
}
