<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
       

    }

    
    //----------------------------------
    // CRUD
    //----------------------------------

    // returns view with form to create new article
    public function create()
    {	
    	return view('articles.create', ['tags' =>Tag::all()]);
    }


    // persists new article 
    public function store(Request $request)
    {
    	// server side validation
        $this->validateImage();
    	$attributes=$this->validateAttributes();

        //set image name
        $imgName= time() .'.'.  $request->image_path->extension();
        $bannerPath = '/images/banners/';
        $thumbPath = '/images/thumbs/';
    	
    	//resize, crop, save banner
    	$imgBanner = $this->resizeImage($request->file('image_path'), 784, null);
    	$this->cropImage($imgBanner, 784,303)->save(public_path($bannerPath) . $imgName, 100);

        //resize, crop, save thumbnail
    	$imgThumb = $this->resizeImage($request->file('image_path'), 368, null);
		$this->cropImage($imgThumb, 368,234)->save(public_path($thumbPath) . $imgName, 100);
     	
     	// set additional attributes for Article model instance
    	$attributes['banner_image_path'] = $bannerPath . $imgName;
    	$attributes['thumb_image_path'] =  $thumbPath . $imgName;
    	$attributes['user_id'] = auth()->user()->id;
    	$attributes['article-trixFields'] = request('article-trixFields');

    	// persist the article
    	Article::create($attributes);

    	return redirect('/home');
    }

	
	// shows article
    public function show(Article $article)
    {
    	return view('articles.show',['article'=>$article]);
    }

    // returns form to create new article
    public function edit(Article $article)
    {   

    	$this->authorize('update', $article);
        return view('articles.edit', ['article'=>$article,'tags' =>Tag::all()]);
    }


    // updates the Article model instance
    public function update(Article $article)
    {
    	
    	// server side validation
    	$attributes=$this->validateAttributes();
     	
     	// setting additional attributes for Article model
    	$attributes['user_id'] = auth()->user()->id;
    	$attributes['article-trixFields'] = request('article-trixFields');

        //update article
    	$article->update($attributes);
    	
    	return view('articles.show', ['article'=>$article]);

    }

    public function destroy(Article $article)
    {
    	$article->delete();
        
        return redirect('/home');
    }


    //----------------------------------
    // HELPERS
    //----------------------------------

    // server side validation
    public function validateAttributes()
    {	
        return request()->validate([
            'title'=> 'required',
            'excerpt' => 'required',
            'tag_id'=>'required'
            ]);
    }   

    // server side image validation
    public function validateImage()
    {
        return request()->validate(['image_path' => 'required|mimes:jpeg,png,jpg,bmp|dimensions:min_width=784,min_height=234']);
    }

    //resize image
    public function resizeImage($path, $width, $height)
    {
    	$img = Image::make($path);
    	return $img->resize($width,$height, function ($constraint) {
    		$constraint->aspectRatio();
    		});
    } 

    //crop image
    public function cropImage($path, $width, $height)
    {
    	$img = Image::make($path);
        return $img->crop($width,$height);
    }

}
