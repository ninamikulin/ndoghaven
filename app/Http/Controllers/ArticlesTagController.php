<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;

class ArticlesTagController extends Controller
{   
	public function __construct()
    {
        $this->middleware('auth');
    }

    // returns view with articles belonging to a specific tag
    public function index(Tag $tag)
    {
    	// fetches articles with the specified tag_id and paginates results
    	$articles = Article::where('tag_id', $tag->id)->paginate(9);

    	return view('articles-tag.index', ['articles' => $articles, 'tag' => $tag]);
    }
}
