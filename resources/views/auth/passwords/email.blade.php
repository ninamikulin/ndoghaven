@extends('layouts.layout-forms')
@section('footer')
<header>
    <h2><strong><text class="fas fa-paw"> </text> Reset Password </strong></h2>
</header>
<div class="container" style="text-align: center;">
    <section>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
        <form method="POST" action="{{ route('password.email') }}" >
            @csrf
            <div class="row gtr-25 container-fluid" >
               <div class="col-6-align-center">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div> 
            </div>                 
        </form>                   
    </section>
</div>
@endsection
