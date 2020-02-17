<?php

namespace App\Http\Controllers;

use App\Article;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        
        $dogFact = $this->getDogFact('GET', 'https://some-random-api.ml/facts/dog');

        $articles = Article::latest()->simplePaginate(9);
        
        return view('home', ['dogFact'=> $dogFact, 'articles'=>$articles]);
    }

    public function getDogFact($method, $url)
    {
        //create new Guzzle Client
        $client=new Client;

        //make the request
        $response = $client->request($method, $url);

        //return the content of the response
        return json_decode($response->getBody()->getContents())->fact;
    }

}
