@extends('layouts.layout')
@section('content')
<header>
    <h2><strong><text class="fas fa-paw"> </text> Confirm Password </strong></h2>
</header>
<div class="container" style="text-align: center;">
    <section>
        <label>{{ __('Please confirm your password before continuing.') }}</label>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="row gtr-25 container-fluid">
                <div class="col-6-align-center">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Confirm Password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
        
                <div class="col-12">         
                    <button type="submit" class="btn btn-primary">
                        {{ __('Confirm Password') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
        </form>
    </section>
</div>
@endsection
