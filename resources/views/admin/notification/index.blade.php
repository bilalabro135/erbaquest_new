@extends('layouts.admin.app', ['title' => 'Send Notification'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Send New Notification</h1>

        <form action="{{route('notification.send')}}" class="user" method="POST" autocomplete="off">
               @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">Notification Detail</h3>                           
                        </div>
                        <div class="card-body">
                            <div class="row">      
                                <div class="col-md-6">                   
                                    <div class="form-group">
                                    <label for="to">To</label>
                                    <select required="" class="form-control @error('to') is-invalid @enderror" name="to" id="to">
                                        <option value="all" {{(old('to') != null && old('to') == 'all') ? 'selected' : ''}}>All User</option>
                                        <option value="user" {{(old('to') != null && old('to') == 'user') ? 'selected' : ''}}>Specific Users</option>
                                        <option value="role" {{(old('to') != null && old('to') == 'role') ? 'selected' : ''}}>Specific Roles</option>
                                    </select>
                                        @error('to')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text"  required="" id="title" class="form-control  @error('title') is-invalid @enderror" name="title" placeholder="Enter Notification Title*" value="{{old('title')}}">        
                                @error('title')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                            <label for="ckeditor1">Body</label>
                            <textarea style="height: 100px;" class=" form-control @error('body') is-invalid @enderror" id="ckeditor1" placeholder="body"  name="body">{{old('body')}}</textarea>
                            @error('body')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <label for="action">Action</label>
                            <input type="url"  required="" id="action" class="form-control  @error('action') is-invalid @enderror" name="action" placeholder="Action*" value="{{old('action')}}">        
                                @error('action')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-3">

                    <div class="card shadow mb-4" id="usersCard" style="@error('users')  @else display: none; @endif">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h1 class="h5  text-gray-800 m-0">All Users</h1>
                        </div>
                        <div class="card-body">
                            @foreach ($users as $userI => $user)
                                <div class="custom-control custom-checkbox small">
                                    <input id="user-{{$userI}}" type="checkbox" class=" custom-control-input " name="users[]" value="{{$user->id}}">
                                    <label for="user-{{$userI}}" class="custom-control-label">{{$user->name}} {{'@' . $user->username}}</label>
                                </div>
                            @endforeach

                                @error('users')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                        </div>
                    </div>

                    <div class="card shadow mb-4" id="rolesCard" style="@error('roles')  @else display: none; @endif">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h1 class="h5  text-gray-800 m-0">All Roles</h1>
                        </div>
                        <div class="card-body">
                            @foreach ($roles as $roleI => $role)
                                <div class="custom-control custom-checkbox small">
                                    <input id="role-{{$roleI}}" type="checkbox" class=" custom-control-input " name="roles[]" value="{{$role->name}}">
                                    <label for="role-{{$roleI}}" class="custom-control-label">{{$role->name}}</label>
                                </div>
                            @endforeach

                                @error('roles')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h1 class="h5  text-gray-800 m-0">Featured Image</h1>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="featured_image" name="featured_image">
                            <div class="file-upload" id="lfm" data-input="featured_image" data-preview="lfm" >
                                Upload Image
                            </div>
                            @error('featured_image')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Send') }}
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
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

<script>

    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
    function removeImage() {
        $('#featured_image').val('');
        $('#lfm').html('Upload')
    }
    $('#to').change(function(){
        if ($(this).val() == 'user') {
            $('#rolesCard').hide();
            $('#usersCard').show();
        }
        else if ($(this).val() == 'role') {
            $('#usersCard').hide();
            $('#rolesCard').show();
        }
        else if ($(this).val() == 'all') {
            $('#rolesCard').hide();
            $('#usersCard').hide();
        }
    })
</script>
@endsection



