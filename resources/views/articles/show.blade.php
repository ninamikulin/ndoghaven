<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

@extends('layouts.layout-forms')
@section('body')

    <section id="main">
    <div class="container">
        <div id="content">
        <article class="box post">
            <header style="text-align: center;">
                <h2 ><strong style="color:#ed786a; font-size: 50px">{{$article->title}}</strong> <br /> <text>by {{$article->user->name}}</text></h2>
               <p>{{$article->excerpt}}</p>
            </header>
            
            <span class="image featured"><img src="{{$article->banner_image_path}}" alt="" /></span>
            
            {!! $article->trixRichText()->where('field', 'content')->first()->content !!}
            <br>
            @can('update', $article)
            <a href="/articles/{{$article->id}}/edit"> <button type="link">Edit</button></a>
            <a href="#ex1" rel="modal:open"><button type="link">Delete</button></a>
            @endcan('update', $post)
            
        </article>
    </div>
</div>
</section>
<!-- Modal HTML embedded directly into document -->
<div id="ex1" class="modal" >
    <p>Are you sure you want to delete this article?</p>
    <ul class="actions">
    <li> <a href="#" rel="modal:close"><button type="link">No, go back.</button></a></li>
    <li> 
        <form method="POST" action="/articles/{{$article->id}}">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-primary">Delete</button>
        </form>
    </li>
    </ul>
</div>
@endsection

