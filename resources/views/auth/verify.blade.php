@extends('layouts.layout-forms')
@section('footer')
<header>
    <h2><strong><text class="fas fa-paw"> </text> Verify Your Email Address </strong></h2>
</header>
<div class="container" style="text-align: center;">
    <section>
        <div class="row gtr-25 container-fluid">
            @if (session('resent'))
            <div class="col-6-align-center">
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            </div>
            @endif
            <div class="col-12">
            {{ __('Before proceeding, please check your email for a verification link.') }}
         
            {{ __('If you did not receive the email')
            </div>
            <div class="col-6-align-center">
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }} </button>.
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
