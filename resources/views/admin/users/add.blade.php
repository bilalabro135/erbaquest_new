@extends('layouts.admin.app', ['title' => 'Add New User'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Add New User</h1>

        <form action="{{route('users.store')}}" method="POST" autocomplete="off">
               @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <div class="form-group w-100 mb-0">
                            
                            <input type="text"  id="username" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Full Name*" required="" value="{{old('name')}}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                           
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                            <label for="email">Email address*</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" required="" placeholder="Enter Email" name="email" value="{{old('email')}}">
                            @error('email')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>

                            <div class="form-group">
                            <label for="exampleInputPassword1">Password*</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" required="" placeholder="Password" name="password" value="">
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
                            <label for="role">Select Role*</label>
                            <div class="form-group">
                                <select name="role" id="role" required="" class="form-control">
                                    <option value="">Select Role</option>
                                     @if(!empty($roles))
                                    @foreach ($roles as $role)
                                        <option value="{{$role}}">{{$role}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            @else
                            <input type="hidden" name="role" value="{{$Settings['default_role']}}">
                            @endif

                            <div class="form-group">
                                <label for="role">Select Verfication Options*</label>
                                <select class="form-control  @error('email_verified_at') is-invalid @enderror" name="email_verified_at" required="">
                                    <option value="">Verfication Options</option>
                                    @if(isset($Settings['email_verification_on_reg']) && $Settings['email_verification_on_reg'] == 1)
                                    <option value="send">Send Verification Email</option>
                                    @endif
                                    <option value="verified">Email Aleady Verified</option>
                                </select>
                                @error('email_verified_at')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection




