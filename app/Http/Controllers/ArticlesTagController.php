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

    public function index(Tag $tag)
    {
    	$articles = Article::where('tag_id', $tag->id)->paginate(9);

    	return view('articles-tag.index', ['articles'=>$articles, 'tag'=>$tag]);
    }
}
