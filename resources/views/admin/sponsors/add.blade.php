@extends('layouts.admin.app', ['title' => 'Add New Sponsor'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}
        </div>
        @endif

         <h1 class="h3 mb-4 text-gray-800">Add New Sponsor</h1>

        <form action="{{route('sponsors.store')}}" method="POST" autocomplete="off" class="user">
               @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">Sponsor Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text"  required="" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Sponsor Name*" value="{{old('name')}}">
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="featured_image">Featured Image</label>
                            <input type="hidden" id="featured_image" name="featured_image">
                            <div class="file-upload lfm" id="lfm" data-input="featured_image" data-preview="lfm" >
                                Upload Image
                            </div>
                            @error('featured_image')
                                <div class="text-danger">
                                    {{$message}}
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
                            </div>

                            <div class="form-group">
                            <label for="order">Order</label>
                            <input type="number" id="order" class="form-control  @error('order') is-invalid @enderror" name="order" placeholder="Enter Order" value="{{old('order')}}">
                                @error('order')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="url">Url</label>
                                <input type="text" id="url" class="form-control" name="url" placeholder="Enter Url" value="{{old('url')}}">
                            </div>

                            <div class="form-group mt-4">
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
    $('.lfm').filemanager('image', {prefix: route_prefix});
    function removeImage() {
        $('#featured_image').val('');
        $('#lfm').html('Upload')
    }
</script>
@endsection



