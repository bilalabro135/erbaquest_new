@extends('layouts.admin.app', ['title' => 'Edit User'])

@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Edit User</h1>

        <form action="{{route('users.update')}}" method="POST" autocomplete="off">
               @csrf
               <input type="hidden" name="id" value="{{$user->id}}">
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>                           
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                            <label for="site_name">{{ __('Full Name*') }}</label>
                            <input type="text"  id="username" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Full Name*" required="" value="{{ (old('name')) ? old('name') : $user->name }}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" required="" placeholder="Enter Email" name="email" value="{{ (old('email')) ? old('email') : $user->email }}">
                            @error('email')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>

                            <div class="form-group">
                            <label for="exampleInputPassword1">Password*</label>
                            <input type="password"  class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password" value="">
                            @error('password')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            @if(Bouncer::can('addRoles') || Bouncer::can('viewRoles'))
                            <div class="form-group">
                                <label for="role">Select Role*</label>
                                <select name="role" id="role" required="" class="form-control">
                                    <option value="">Select Role*</option>
                                    @if(!empty($roles))
                                    @foreach ($roles as $role)
                                        @if(!empty($user->getRoles()[0]) && $user->getRoles()[0] == $role)
                                                <option value="{{$role}}" selected>{{$role}}</option>
                                        @else
                                                <option value="{{$role}}" >{{$role}}</option>
                                        @endif
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="role" value="{{(!empty($user->getRoles()[0])) ? $user->getRoles()[0] : $Settings['default_role']}}">
                            @endif
                            
                            <div class="form-group">
                                <label for="role">Select Verfication Options*</label>
                                <select class="form-control  @error('email_verified_at') is-invalid @enderror" name="email_verified_at" required="">
                                    <option value="">Verfication Options*</option>
                                    @if($user->email_verified_at == null)
                                        <option value="send">Send Verification Email</option>
                                        <option value="verified">Email Aleady Verified</option>
                                    @else
                                        <option value="" selected="selected">Verified</option>
                                        <option value="null" >Not Verified</option>
                                    @endif

                                </select>
                                @error('email_verified_at')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection




