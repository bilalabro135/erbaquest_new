@extends('layouts.admin.app', ['title' => 'Add New User'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Add Vendor Profile</h1>

        <form action="{{route('admin.vendor.store')}}" method="POST" autocomplete="off">
            @csrf
            <input type="hidden" name="action" value="store">
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           Vendor Profile
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">Public profile Name*</label>
                                <input type="text"  id="username" class="form-control  @error('public_profile_name') is-invalid @enderror" name="public_profile_name" placeholder="Enter Full Name" required="" value="{{old('public_profile_name')}}">
                                @error('public_profile_name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
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
                                <label for="website">Website</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror" id="website" aria-describedby="emailHelp" placeholder="Enter Website" name="website" value="{{  old('website')  }}">
                                @error('website')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" aria-describedby="emailHelp" placeholder="Enter Instagram" name="instagram" value="{{  old('instagram')  }}">
                                @error('instagram')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="facebook" aria-describedby="emailHelp" placeholder="Enter Facebook" name="facebook" value="{{  old('facebook')  }}">
                                @error('facebook')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" aria-describedby="emailHelp" placeholder="Enter Twitter" name="twitter" value="{{  old('twitter')  }}">
                                @error('twitter')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="youtube">Youtube</label>
                                <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="youtube" aria-describedby="emailHelp" placeholder="Enter Youtube" name="youtube" value="{{  old('youtube')  }}">
                                @error('youtube')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="linkedin">Linkedin</label>
                                <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="linkedin" aria-describedby="emailHelp" placeholder="Enter Linkedin" name="linkedin" value="{{  old('linkedin')  }}">
                                @error('linkedin')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text"  class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                                <label for="descreption">Descreption</label>
                                <textarea class="form-control" id="descreption" aria-describedby="emailHelp" required="" placeholder="Enter Descreption" name="descreption">@error('descreption') is-invalid @enderror{{  old('descreption')  }}</textarea>
                                @error('descreption')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card shadow profile_image mb-4">
                        <div class="card-header  py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Featured Image</h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="profile_image" name="featured">
                            <img class="myImage" src="">
                            <div class="file-upload" id="lfm" data-input="profile_image" data-preview="lfm" >
                                Upload Image
                            </div>
                            @error('profile_image')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
                        </div>
                    </div>
                    <div class="card shadow profile_image mb-4">
                        <div class="card-header  py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Picture</h6>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="profile_pic" name="picture">
                            <div class="file-upload" id="lfm1" data-input="profile_pic" data-preview="lfm1" >
                                Upload Image
                            </div>
                            @error('profile_image')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removePic()">Remove Image</a>
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <label for="user_id">Select User*</label>
                            <div class="form-group">
                                <select name="user_id" id="user_id" required="" class="form-control">
                                    <option selected disabled>--Please select--</option>
                                    @foreach($users as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('email_verified_at')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif

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




@section('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script type="text/javascript">
    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix});

    var route_prefix1 = "{{route('unisharp.lfm.show')}}";
    $('#lfm1').filemanager('image', {prefix: route_prefix1});

    function removeImage() {
        $('#profile_image').val('');
        $('#lfm').html('Upload Image')
    }

    function removePic() {
        $('#profile_pic').val('');
        $('#lfm1').html('Upload Image')
    }
</script>
@endsection
