
@extends('layouts.admin.app', ['title' => 'Edit Package'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Edit Package</h1>

        <form action="{{route('packages.update', ['package'=> $package->id ])}}" method="POST" autocomplete="off" class="package">            
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
                            <input type="text"  required="" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Package Name*" value="{{ (old('name')) ? old('name') : $package->name }}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                            <label for="ckeditor1">Description</label>
                            <textarea class=" form-control @error('description') is-invalid @enderror" id="ckeditor1" placeholder="Description"  name="description">{{ (old('description')) ? old('description') : $package->description }}</textarea>
                            @error('description')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" placeholder="Short Description" name="short_description">{{ (old('short_description')) ? old('short_description') : $package->short_description }}</textarea>
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
                                    <option value="Day" {{ ($package->reccuring_every == 'Day') ? 'selected="selected"' : ''}} >Day</option>
                                    <option {{ ($package->reccuring_every == 'Month') ? 'selected="selected"' : ''}} value="Month">Month</option>
                                    <option {{ ($package->reccuring_every == 'Year') ? 'selected="selected"' : ''}} value="Year">Year</option>
                                </select>
                                
                                @error('reccuring_every')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                                                        <div class="form-group">
                            <label for="price">Price</label>

                            <input type="number"  id="price" class="form-control  @error('price') is-invalid @enderror" name="price" placeholder="Meta Title" value="{{ (old('price')) ? old('price') : $package->price }}"> 

                                @error('price')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                            <label for="duration">Duration</label>

                            <input type="number"  id="duration" class="form-control  @error('duration') is-invalid @enderror" name="duration" placeholder="Meta Title" value="{{ (old('duration')) ? old('duration') : $package->duration }}">       
                                @error('duration')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>


                    
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-block px-5">
                                {{ __('Update') }}
                            </button>
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

<script>
    var options = {
        filebrowserImageBrowseUrl: '{{ route("unisharp.lfm.show", ["type" => "Images"])}}',
        filebrowserImageUploadUrl: '{{ route("unisharp.lfm.upload", ["type" => "Images", "_token" => ''])}}',
        filebrowserBrowseUrl: '{{ route("unisharp.lfm.show", ["type" => "Files"])}}',
        filebrowserUploadUrl: '{{ route("unisharp.lfm.upload", ["type" => "Files", "_token" => ''])}}'
    };
    $(document).ready(function(){
        CKEDITOR.replace('ckeditor1',  options)
    })
    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
        $('#name').blur(function (e) {
            if ($('#slug').val() == '') {
                $('#slug').val(
                $(this).val().toLowerCase()
                 .replace(/[^\w ]+/g, '')
                 .replace(/ +/g, '-')
                );
            }
        })
</script>
@endsection



