
@extends('layouts.layout-forms')
@section('form')
<header>
    <h2><strong><text class="fas fa-paw"> </text> Edit article </strong></h2>
</header>
<div class="container" style="text-align: center;">        
    <section>
        <form method="POST" action="/articles/{{ $article->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gtr-50 container-fluid">
                 <div class="col-12">
                    <img id="img" width="210" src="{{ $article->thumb_image_path }}" alt="" />
                </div>
                <div class="col-12">                   
                   <select class="form-control" id="tag_id" name="tag_id">
                        <option>Select category</option>
                        @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                   </select>       
                </div>                
                <div class="col-12">
                    <input id="title" type="text" class="form-control" name="title" value="{{ $article->title }}" placeholder="Title" required  >
                </div>
                <div class="col-12">
                    <input id="excerpt" type="text" class="form-control" name="excerpt" placeholder="Excerpt" value="{{ $article->excerpt }}"required >
                </div>               
                <div class="col-12">
                   <input id="trix-content" type="hidden" name="content" value="{!! $article->trixRichText()->where('field', 'content')->first()->content !!}">
                   <trix-editor class="trix-content" input="trix-content"></trix-editor>
                </div> 
                <div class="col-6-align-center">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>
<!-- Form -->
@endsection

