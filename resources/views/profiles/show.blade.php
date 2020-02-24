@extends('layouts.layout-forms')

@section('footer')
<header>
    <h2 ><strong><text class="fas fa-paw"> </text> My Profile </strong></h2>
</header>
<div class="container" style="text-align: center;">
    <section>          
        <div class="row gtr-25 container-fluid">
            <div class="col-6-align-center">
                <h3><strong>Name:</strong> {{$user->name}}</h3>                    
            </div>
             <div class="col-6-align-center">
                <h3><strong>E-mail:</strong> {{$user->email}}</h3>              
            </div>
            <div class="col-6-align-center">
                <h3><strong>Article counter:</strong> <a href="">You have written {{ $user->articles()->count() != 1 ? $user->articles()->count() . ' articles': $user->articles()->count() . ' article' }} </a> </h3>             
            </div>
            <div class="col-6-align-center">
                <h3><strong><a href="/password/reset">Reset my password</strong> </a> </h3>
              
            </div>
            <div class="col-6-align-center">
                 <a href="/profile/{{ $user->id }}/edit">
                    <button type="link" class="btn btn-primary">Edit</button></a> 
            </div> 
        </div>        
    </section>
</div>
@endsection
