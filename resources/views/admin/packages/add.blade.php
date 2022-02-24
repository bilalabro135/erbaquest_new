@extends('layouts.admin.app', ['title' => 'Add New Package'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Add New Package</h1>

        <form action="{{route('packages.store')}}" method="POST" autocomplete="off" class="user">
               @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">Package Information</h3>                           
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text"  required="" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Package Name*" value="{{old('name')}}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="ckeditor1">Description</label>
                            <textarea class=" form-control @error('description') is-invalid @enderror" id="ckeditor1" placeholder="Description"  name="description">{{old('description')}} </textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group ">
                            <label for="short_description">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" placeholder="Short Description" name="short_description">{{old('short_description')}}</textarea>
                            @error('short_description')
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
                            <div class="form-group">
                                <label for="reccuring_every">Select Recurring*</label>
                                <select name="reccuring_every" id="reccuring_every" required="" class="form-control">
                                    <option value="">Select Reccuring</option>
                                    <option value="day" selected>Day</option>
                                    <option value="month">Month</option>
                                    <option value="year">Year</option>
                                </select>
                                
                                @error('reccuring_every')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number"  required="" id="price" class="form-control  @error('price') is-invalid @enderror" name="price" placeholder="Enter Price*" value="{{old('name')}}">        
                                @error('price')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="number"  required="" id="duration" class="form-control  @error('duration') is-invalid @enderror" name="duration" placeholder="Enter duration*" value="{{old('name')}}">        
                                @error('duration')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-primary btn-block px-5">
                                        {{ __('Add') }}
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>                    
            </div>

        </form>
    </div>
@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script type="text/javascript">
        var options = {
        filebrowserImageBrowseUrl: '{{ route("unisharp.lfm.show", ["type" => "Images"])}}',
        filebrowserImageUploadUrl: '{{ route("unisharp.lfm.upload", ["type" => "Images", "_token" => ''])}}',
        filebrowserBrowseUrl: '{{ route("unisharp.lfm.show", ["type" => "Files"])}}',
        filebrowserUploadUrl: '{{ route("unisharp.lfm.upload", ["type" => "Files", "_token" => ''])}}'
    };
    $(document).ready(function(){
        CKEDITOR.replace('ckeditor1',  options)
    })
</script>
@endsection



