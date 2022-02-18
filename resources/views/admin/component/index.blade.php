@extends('layouts.admin.app', ['title' => 'Component Settings'])
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
        <div class="row" id="components_settings">
            <div class="col-md-3">
            <div class="card shadow mb-4  px-0">
                <div class="card-header py-3 ">
                    <h6 class="m-0 font-weight-bold text-primary">All Components</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-tabs flex-column text-capitalize">
                        @foreach($files as $file)
                          <li class="nav-item">
                            <a class="nav-link {{($type == $file) ? 'active' : ''}}"  href="{{route('components' , ['type' => $file])}}">{{$file}}</a>
                          </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            </div>
            <div class="col-md-9 ">
                 @include('admin.component.forms.' . $type)
            </div>
        </div>
    </div>
@endsection
