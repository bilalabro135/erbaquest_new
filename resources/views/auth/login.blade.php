@extends('layouts.admin.app', ['body_class' => 'bg-gradient-primary', 'title' => 'Login', 'sidebar' => false, 'topbar' => false, 'body_class' => 'ht_100'])




@section('content')
 
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
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
                                        <h1 class="h4 text-gray-900 mb-4 vc_head">Welcome Back!</h1>
                                        @if(session('msg'))
                                        <div class="alert alert-{{session('msg_type')}}">
                                            {{session('msg')}}                                            
                                        </div> 
                                        @endif
                                         @error('authenticate')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <form class="user" method="POST" action="{{ route('authenticate') }}">
                                         @csrf
                                        <div class="form-group">
                                                <input id="username" type="text"
                                           class="form-control form-control-user @error('username') is-invalid @enderror" name="username"
                                           value="{{ old('username') }}" placeholder="{{ __('E-Mail Address Or Username') }}" required autocomplete="username" autofocus>

              
                                        </div>
                                        <div class="form-group">
                                                <input id="password" type="password"
                                           class="form-control  form-control-user @error('password') is-invalid @enderror" name="password" placeholder="{{ __('Password') }}" 
                                           required autocomplete="current-password">

                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input class="custom-control-input" type="checkbox" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            {{ __('Login') }}
                                        </button>
                                    </form>
                                    <hr>

                                    @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                    @endif
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