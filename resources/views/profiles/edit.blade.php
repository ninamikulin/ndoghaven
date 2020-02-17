@extends('layouts.layout-forms')
@section('form')
<header>
    <h2><strong><text class="fas fa-paw"> </text> Update Profile </strong></h2>
</header>

    <div class="container" style="text-align: center;">
        @if($errors->any())
                    @foreach($errors->all() as $error)
                    {{$error}}
                    @endforeach
                    @endif
        <section>
            <form method="POST" action="/profile/{{$user->id}}">
                @csrf
                @method('PUT')
                <div class="row gtr-50 container-fluid">
  
                    <div class="col-6-align-center">
                        <input id="title" type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Title" required  >
                    </div>
                    

                    <div class="col-6-align-center">
                        <input id="name" type="text" class="form-control" name="email" placeholder="email" value="{{ $user->email }}"required >
                    </div>               
                    <div class="col-6-align-center">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </section>

    </div>
@endsection
