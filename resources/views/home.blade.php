@extends('layouts.layout')
@section('title')
<h1 id="logo"><a href="/home">DogHaven</a></h1>
<br>
<p>Dog fact of the day: </p>{{$dogFact ?? ''}} </br>
@endsection
@section('body')
<section id="features">
<div class="container">
    <header>
        <h2>Latest articles </h2>
    </header>
    <div class="row aln-center">
        @foreach($articles as $article)
        <div class="col-4 col-6-medium col-12-small">
        <!-- Feature -->
            <section>
                <a href="/articles/{{ $article->id }}" class="image featured"><img src="{{ $article->thumb_image_path }}" alt="" /></a>
                <header>
                    <h3>{{ $article->title }}</h3>
                </header>
                <p>{{$article->excerpt}}</p>
            </section>           
        </div>
        @endforeach       
    </div> 
</div>
@if (!empty($articles->links()))
<div class="mt-3">
    <div>{{ $articles->links() }}</div>
<div>
@endif
</section>
@endsection
