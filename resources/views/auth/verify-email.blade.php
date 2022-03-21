@extends('layouts.front.app', ['body_class' => 'bg-gradient-primary', 'title' => 'Verify Email', 'sidebar' => false, 'topbar' => false])

@section('content')

<section class="inner-banner" style="background: url({{env('APP_URL').'storage/photos/1/inner-banner.jpg'}});">
  <div class="container">
    <h1 class="vc_heading ft-saira text-center">Verification</h1>
  </div>
</section>
    <div class="container">
        <div class="row justify-content-center align-items-center"  style="height: 50vh;">
            <div class="col-md-8">

                <div class="email_template_card">
                    <h2><strong>{{auth()->user()->name}}</strong> {{ __('Verify Your Email Address First') }}</h2>
                    <p> {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection