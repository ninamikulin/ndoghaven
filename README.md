# DogHaven

1. [About](#introduction)   
2. [Basic Laravel Auth](#basic-laravel-auth)   
3. [Integrating HTML5up template](#integrating-html5up-template)  
4. [CRUD for Articles](#crud-for-articles)  
  i. [CREATE](#create)  
    ii. [READ](#read)  
    iii. [UPDATE](#update)  
    iv. [DELETE](#delete) 
5. [Image resizing and cropping](#image-resizing-and-cropping)
6. [Rich text editor](#rich-text-editor)
7. [Eloquent relationships](#eloquent-relationships)
8. [Middleware](#middleware)
9. [Policy](#policy)
   

## About 

DogHaven is a simple CRUD website made with Laravel 6 that allows users to create an account/profile, post new articles and read other user's articles.

   * Basic Laravel login is used for creating accounts and authenticating users.
   * An html5up template has been integrated. 
   * [Some random api](https://some-random-api.ml/) is called on the homepage using [Guzzle](http://docs.guzzlephp.org/en/stable/) to return a random dog fact on the home page.
   * Users can create, edit and delete their articles and profiles. The admin of the website can view, edit and delete all articles and profiles.  
   * Laravel's auth middleware is used for checking if the user is authenticated, an additional middleware has been created to determine if the user can view a profile, and a policy is used to determine if the user can edit and delete an article.
   * Possibility to upload and resize images has been implemented.
   * A rich text editor is used to format the body of the article.
   * There are 5 main categories for articles (random, training, nutrition, grooming), eloquent relationships are created accordingly.
  



## Basic Laravel Auth

Create basic Laravel auth: 
- `composer require laravel/ui --dev`
- `npm install && npm run dev`
- `php artisan ui vue --auth` - installs a layout view, registration and login views, routes for all authentication end-points and a HomeController.

## Integrating HTML5up template

- store template assets (CSS, HTML and JS) in the `/public` folder
- create layouts to extend HTML
- changing Laravel's default email sent in the register 


## SomeRandomApi

<details><summary>returns a random dog fact every time the homepage is loaded</summary>

```php
// /app/Http/Controllers/HomeController.php

//calls the api and returns the content of the response
public function getDogFact($method, $url)
{
  //create new Guzzle Client
  $client = new Client;

  //make the request
  $response = $client->request($method, $url);

  //return the content of the response
  return json_decode($response->getBody()->getContents())->fact;
}
```

```php
// /app/Http/Controllers/HomeController.php

// returns a random dog fact
$dogFact = $this->getDogFact('GET', 'https://some-random-api.ml/facts/dog');
```

</details>

## CRUD for Articles

### Create

To create a new article 2 `ArticleController` methods are used:
- `create` -> returns view with form to create new article 

<details> 
<summary>  store -> persists the new article in the DB  </summary>

- validates the request attributes  
- resizes the images to thumbnail and banner size and saves them in the public folder  
- persists the new article in the DB  

```php
// /app/Http/Controllers/ArticleController.php

// persists new article 
public function store(Request $request)
{
  // server side validation
  $this->validateImage();
  $attributes = $this->validateAttributes();

  // set image name
  $imgName = time() . '.' .  $request->image_path->extension();
  $bannerPath = '/images/banners/';
  $thumbPath = '/images/thumbs/';
  
  // resize, crop, save banner
  $imgBanner = $this->resizeImage($request->file('image_path'), 784, null);
  $this->cropImage($imgBanner, 784, 303)->save(public_path($bannerPath) . $imgName, 100);

    // resize, crop, save thumbnail
  $imgThumb = $this->resizeImage($request->file('image_path'), 368, null);
  $this->cropImage($imgThumb, 368, 234)->save(public_path($thumbPath) . $imgName, 100);
  
  // set additional attributes for Article model instance
  $attributes['banner_image_path'] = $bannerPath . $imgName;
  $attributes['thumb_image_path'] =  $thumbPath . $imgName;
  $attributes['user_id'] = auth()->user()->id;
  $attributes['article-trixFields'] = request('article-trixFields');

  // persist the article
  Article::create($attributes);

  return redirect('/home');
}
```

</details>

### Read

<details>
<summary>view all articles - HomeController: </summary>

```php
// /app/Http/Controllers/HomeController.php

public function index()
{   
  // calls the api to return a random dog fact
  $dogFact = $this->getDogFact('GET', 'https://some-random-api.ml/facts/dog');

  // returns all the articles ordered by most recent and paginates the results
  $articles = Article::latest()->simplePaginate(9);
  
  return view('home', ['dogFact' => $dogFact, 'articles' => $articles]);
}
```
</details>
<details>
<summary>show article - ArticleController  </summary>

```php
// /app/Http/Controllers/ArticleController.php

// shows article
public function show(Article $article)
{
  return view('articles.show', ['article' => $article]);
}
```
</details>
<details>
<summary>display pagination in view  </summary>

```html
@if (!empty($articles->links()))
<div class="mt-3">
  <div>{{ $articles->links() }}</div>
<div>
@endif
```
</details>

### Update

To create a new article 2 `ArticleController` methods are used:

- `edit` -> returns view with form to edit an existing article  

<details> 
<summary> update -> persists the changes to the article  </summary>  

- validates the request attributes  
- resizes the images to thumbnail and banner size and saves them in the public folder  
- persists the new article in the DB  
- image can not be changed  


```php
// /app/Http/Controllers/ArticleController.php 

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
  
  return view('articles.show', ['article' => $article]);
}
```

</details>

### Delete

<details> 
<summary> destroy-> deletes the record from the DB  </summary>

```php
// /app/Http/Controllers/ArticleController.php
public function destroy(Article $article)
{
  $article->delete();
    
  return redirect('/home');
}
 ```
</details>

<details><summary>Modal to confirm delete</summary>

```html 
<!-- /resources/views/articles/show.blade.php -->

<!-- jQuery Script - <head> of HTML-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

<!-- Button to open modal -->
@can('update', $article)
<a href="#ex1" rel="modal:open"><button type="link">Delete</button></a>
@endcan('update', $post)

<!-- Modal HTML embedded directly into document -->
<div id="ex1" class="modal" >
  <p>Are you sure you want to delete this article?</p>
  <ul class="actions">
    <li> <a href="#" rel="modal:close"><button type="link">No, go back.</button></a></li>
    <li> 
        <form method="POST" action="/articles/{{ $article->id }}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-primary">Delete</button>
        </form>
    </li>
  </ul>
</div>
```

</details>

## Image resizing and cropping  

For image resizing and cropping the [Intervention Image library](http://image.intervention.io/getting_started/installation) was used.  

<details><summary> Resize method  </summary>

```php
// /app/Http/Controllers/ArticleController.php
use Intervention\Image\Facades\Image;

//resize image
public function resizeImage($path, $width, $height)
{
  $img = Image::make($path);
  return $img->resize($width, $height, function ($constraint) {
    $constraint->aspectRatio();
    });
} 
```
</details>
<details><summary> Crop method  </summary>

```php
// /app/Http/Controllers/ArticleController.php
use Intervention\Image\Facades\Image;

//crop image
public function cropImage($path, $width, $height)
{
$img = Image::make($path);
return $img->crop($width, $height);
}
```

</details>
<details><summary>Resize and crop image when creating new article  </summary>

```php
// /app/Http/Controllers/ArticleController.php

// persists new article 
public function store(Request $request)
{
  // server side validation
  $this->validateImage();
  $attributes = $this->validateAttributes();

  //set image name
  $imgName = time() . '.' . $request->image_path->extension();
  $bannerPath = '/images/banners/';
  $thumbPath = '/images/thumbs/';
  
  //resize, crop, save banner
  $imgBanner = $this->resizeImage($request->file('image_path'), 784, null);
  $this->cropImage($imgBanner, 784, 303)->save(public_path($bannerPath) . $imgName, 100);

    //resize, crop, save thumbnail
  $imgThumb = $this->resizeImage($request->file('image_path'), 368, null);
  $this->cropImage($imgThumb, 368, 234)->save(public_path($thumbPath) . $imgName, 100);
  
  // set additional attributes for Article model instance
  $attributes['banner_image_path'] = $bannerPath . $imgName;
  $attributes['thumb_image_path'] =  $thumbPath . $imgName;
  $attributes['user_id'] = auth()->user()->id;
  $attributes['article-trixFields'] = request('article-trixFields');

  // persist the article
  Article::create($attributes);

  return redirect('/home');
}
```
</details>

## Rich text editor

For image resizing and cropping the [Trix Editor](https://github.com/Te7a-Houdini/laravel-trix) was used. 

<details>
<summary>Create a trix rich text field</summary>

```html
<!-- /resources/views/articles/create.blade.php -->

<div class="col-12">
   <input id="trix-content" type="hidden" name="article-trixFields[content]">
   <trix-editor class="trix-content" input="trix-content" id="trix-content"></trix-editor>                        
</div>
```

</details>
<details>
<summary>Store the content of the field as rich text  </summary>

```php
// /app/Http/Controllers/ArticleController.php
// setting the attribute before creating a new article

$attributes['article-trixFields'] = request('article-trixFields');
```
</details>
<details>
<summary>Display the content of the field as rich text  </summary>

```html
<!-- /resources/views/articles/show.blade.php-->
<!-- setting the attribute before creating a new article-->

{!! $article->trixRichText()->where('field', 'content')->first()->content !! }
```

</details>

## Eloquent relationships

<details><summary>User  </summary>

- hasMany Articles  

```php
// has many articles
public function articles()
{
  return $this->hasMany(Article::class);
}
```
</details>
<details><summary>Article  </summary>

- belongsTo one User   

```php
// belongs to one user
public function user()
{
  return $this->belongsTo(User::class);
}
```

- belongsTo one Tag  
```php
//belongs to many Tags
public function tags()
{
  return $this->belongsTo(Tag::class);
}
```

</details>
<details><summary>Tag  </summary>

- hasMany Articles

```php
// belongs to many articles
public function articles()
{
  return $this->hasMany(Article::class);
}
```
</details>


## Middleware  

All users must be authenticated to view website - Laravel's `auth middleware` has been added to all controllers except the ones handling authorization.  

<details><summary>Added middleware to check if user can view a profile - viewing profiles</summary>

```php
<?php

namespace App\Http\Middleware;

use Closure;

class checkIfAdminOrAuthUser
{
/**
* Handle an incoming request.
*
* @param  \Illuminate\Http\Request  $request
* @param  \Closure  $next
* @return mixed
*/
  public function handle($request, Closure $next)
  {
    if ($request->user()->isAdmin() | $request->route('user')->id === auth()->id()) 
    {
      return $next($request);

    } else {

      abort(403, 'Unauthorized action.');
    }
  }
```
</details>

## Policy

<details><summary>Article policy -> only auth users and admin can edit and delete an article</summary>

```php
<?php

namespace App\Policies;

use App\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
  use HandlesAuthorization;

  /**
   * Determine whether the user can update the article.
   *
   * @param  \App\User  $user
   * @param  \App\Article  $article
   * @return mixed
   */
  public function update(User $user, Article $article)
  {
    return $article->user_id === $user->id;
  }
}
```
</details>

