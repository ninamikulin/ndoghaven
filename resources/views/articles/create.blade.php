@extends('layouts.layout-forms')
@section('form')
<header>
    <h2><strong><text class="fas fa-paw"> </text> Create new article </strong></h2>
</header>
<div class="container" style="text-align: center;">
    <section>
        <!-- Form -->
        <form method="POST" action="/articles" enctype="multipart/form-data">
        @csrf
            <div class="row gtr-50 container-fluid">
                 <div class="col-12">
                    <button><input id="file" type="file" class="btn btn-primary" name="image_path"  accept="image/*" style="cursor:pointer;opacity:0; position:absolute;left: 0;top: 0;" required autofocus onchange="loadFile(event)">Select image</button>
                    <label></label>
                    <img id="img" width="210"  src="https://placedog.net/500">
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
                    <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title" required  >
                </div>
                <div class="col-12">
                    <input id="excerpt" type="text" class="form-control" name="excerpt" placeholder="Excerpt" required >
                </div>
                <div class="col-12">
                    <input id="trix-content" type="hidden" name="article-trixFields[content]">
                   <trix-editor class="trix-content" input="trix-content" id="trix-content"></trix-editor>             
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
<!-- Displays the image-->
<script type="text/javascript">   
const reader = new FileReader();
const fileInput = document.getElementById("file");
const img = document.getElementById("img");

reader.onload = e => {
  img.src = e.target.result;
}

fileInput.addEventListener('change', e => {
  const f = e.target.files[0];
  reader.readAsDataURL(f);
})
</script>
@endsection

