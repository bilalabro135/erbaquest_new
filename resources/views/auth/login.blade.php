@extends('layouts.admin.app', ['body_class' => 'bg-gradient-primary', 'title' => 'Login', 'sidebar' => false, 'topbar' => false])




@section('content')
 
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
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
                                                <input id="email" type="email"
                                           class="form-control form-control-user @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autocomplete="email" autofocus>

              
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

                                    <div class="text-center">
                                        @if (isset($Settings['allow_forget_password']) && $Settings['allow_forget_password'] == 1)
                                            <a class="small" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                      @if (isset($Settings['allow_registrstion']) && $Settings['allow_registrstion'] == 1)
                                            <a class="small" href="{{ route('register') }}">{{ __('Register') }}</a>
                                      @endif
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