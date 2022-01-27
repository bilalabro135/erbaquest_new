@extends('layouts.admin.app', ['title' => 'Edit Role'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Edit Role</h1>

        <form class="user" action="{{route('roles.update', [$role->id])}}" method="POST" autocomplete="off">
               @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <div class="form-group w-100 mb-0">
                            
                            <input type="text"  id="username" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Role Name*" required="" value="{!! $role->name !!}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                                
                            </div>
                           
                        </div>
                        <div class="card-body px-5">
                            <h3 class="h3 mb-4">Permisions</h3>

                            @foreach(config('settings.permissions') as $key => $permissions)
                                <div class="role-permission">
                                    <h4 class="h5 mt-4">
                                        <div class="custom-control custom-checkbox mr-3">
                                            <input type="checkbox" id="{{$key}}" class=" custom-control-input " name="{{$key}}">
                                            <label for="{{$key}}" class=" h5 custom-control-label">
                                                {{$key}}
                                            </label>
                                        </div>
                                    </h4>
                                    <div class="form-group mb-4 d-flex">
                                    @foreach($permissions as $name => $permission)
                                    <div class="custom-control custom-checkbox mr-3 small">
                                        <input id="{{$permission}}" type="checkbox" class=" custom-control-input " name="permission[{{$permission}}]" {!! in_array($permission ,$abilitiesarray) == true ?"checked":"" !!}  value="1" >
                                        <label for="{{$permission}}" class="custom-control-label">
                                            {{$name}}
                                        </label>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                                <hr class="sidebar-divider">
                            @endforeach

                            <div class="form-group mt-4">
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




@section('scripts')
    <script type="text/javascript">    
        $('.role-permission h4 input[type="checkbox"]').change(function () {
            if($(this).is(':checked')){
                $(this).parents('.role-permission').find('input[type="checkbox"]').prop('checked', 'checked');
            }
            else{
                $(this).parents('.role-permission').find('input[type="checkbox"]').prop('checked', false);
            }
        })
    </script>
@endsection
