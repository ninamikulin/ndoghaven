@extends('layouts.layout-forms')
@section('footer')
<header>
    <h2><strong><text class="fas fa-paw"> </text> Register </strong></h2>
</header>
<div class="container" style="text-align: center;">
    <section>
        <form method="POST" action="{{ route('register') }}">
        @csrf
         <div class="row gtr-25 container-fluid">
            <div class="col-6-align-center">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Name" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6-align-center">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6-align-center">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password"required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-6-align-center">
                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
            </div>
            <div class="col-6-align-center">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
         </div>
        </form>
    </section>
</div>
@endsection
