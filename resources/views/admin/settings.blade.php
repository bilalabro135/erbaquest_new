@extends('layouts.admin.app', ['title' => 'Settings'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
        @error('name')
        <div class="alert alert-danger">
            {{$message}}                                            
        </div>
        @endif
        <div class="row">
            <div class="col-md-3">
            <div class="card shadow mb-4  px-0">
                <div class="card-header py-3 ">
                    <h6 class="m-0 font-weight-bold text-primary">All Settings</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-tabs flex-column">
                      <li class="nav-item">
                        <a class="nav-link {{($type =='general') ? 'active' : ''}}"  href="{{route('settings' , ['type' => 'general'])}}">General</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{($type =='registration') ? 'active' : ''}}"  href="{{route('settings' , ['type' => 'registration'])}}">Registration</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link {{($type =='socialmedia') ? 'active' : ''}}"  href="{{route('settings' , ['type' => 'socialmedia'])}}">Social Media</a>
                      </li>
                    </ul>
                </div>
            </div>
            </div>
            <div class="col-md-9 ">
                    @include('admin.settings.' . $type)
            </div>
        </div>
    </div>
@endsection
