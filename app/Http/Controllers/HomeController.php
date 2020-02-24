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

    // shows the homepage
    public function index()
    {   
        // makes request to get random dog fact
        $dogFact = $this->getDogFact('GET', 'https://some-random-api.ml/facts/dog');

        // fetches the articles from the DB
        $articles = Article::latest()->simplePaginate(9);
        
        return view('home', ['dogFact' => $dogFact, 'articles' => $articles]);
    }

    // makes request and returns string
    public function getDogFact($method, $url)
    {
        //create new Guzzle Client
        $client = new Client;

        //make the request
        $response = $client->request($method, $url);

        //return the content of the response
        return json_decode($response->getBody()->getContents())->fact;
    }

}
