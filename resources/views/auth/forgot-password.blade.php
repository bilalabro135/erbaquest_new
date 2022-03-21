@extends('layouts.admin.app', ['body_class' => 'bg-gradient-primary', 'title' => 'Forget Passsword', 'sidebar' => false, 'topbar' => false, 'body_class' => 'ht_100'])
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5 ">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row form_area">
                            <div class="col-lg-4 d-none d-lg-block">
                                <div class="logo_area">
                                    {!! ($globalsettings->getValue('site_logo')) ? '<img src="' .$globalsettings->getValue('site_logo') . '">' : config('app.name', 'Laravel') !!}    
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4 vc_head">{{ __('Reset Password') }}</h1>
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                    </div>
                                    <form class="user" method="POST" action="{{ route('password.email') }}">
                                         @csrf
                                        <div class="form-group">
                                            <input id="email" type="email" class="form-control-user form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block forgot_pass_btn">
                                            {{ __('Send Password Reset Link') }}
                                        </button>
                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        @if (isset($Settings['allow_forget_password']) && $Settings['allow_forget_password'] == 1)
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                            <a class="small" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection