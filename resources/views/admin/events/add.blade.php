@extends('layouts.admin.app', ['title' => 'Add New Blog'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Add New Event</h1>

        <form action="{{route('events.store')}}" method="POST" autocomplete="off" class="user">
               @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">Event Information</h3>                           
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text"  required="" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Event Name*" value="{{old('name')}}">        
                                        @error('name')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="event_date">Event Date</label>
                                    <input type="date"  required="" id="event_date" class="form-control  @error('event_date') is-invalid @enderror" name="event_date" placeholder="Enter Event Name*" value="{{old('event_date')}}">        
                                        @error('event_date')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="featured_image">Featured Image</label>
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
                                </div>
                                <div class="col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div class="card-header">
                                            <h3 class="h5 my-0">Gallery</h3>
                                        </div>
                                         <div class="card-body gallery">
                                            <div class="gallery_images">
                                                <div class="add_image" onclick="addGalleryImage()">
                                                    <i class="fas fa-plus"></i>
                                                </div>
                                            </div>
                                            @error('gallery')
                                                    <div class="text-danger">
                                                        {{$message}}                                            
                                                    </div>
                                                @endif
                                         </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text"  required="" id="address" class="form-control  @error('address') is-invalid @enderror" name="address" placeholder="Address" value="{{old('address')}}">        
                                        @error('address')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="type">Type Of Event</label>
                                    <input type="text"  required="" id="type" class="form-control  @error('type') is-invalid @enderror" name="type" placeholder="Enter Event Name*" value="{{old('type')}}">        
                                        @error('type')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="door_dontation">EXPECTED DOOR DONATION</label>
                                    <input type="number"  required="" id="door_dontation" class="form-control  @error('door_dontation') is-invalid @enderror" name="door_dontation" placeholder="$100.00" value="{{old('door_dontation')}}">        
                                        @error('door_dontation')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="vip_dontation">VIP DONATION</label>
                                    <input type="number"  required="" id="vip_dontation" class="form-control  @error('vip_dontation') is-invalid @enderror" name="vip_dontation" placeholder="$10.0" value="{{old('vip_dontation')}}">        
                                        @error('vip_dontation')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="vip_perk">VIP Perks</label>
                                    <input type="number"  required="" id="vip_perk" class="form-control  @error('vip_perk') is-invalid @enderror" name="vip_perk" placeholder="$10.0" value="{{old('vip_perk')}}">        
                                        @error('vip_perk')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="charity">Charity</label>
                                    <input type="number"  required="" id="charity" class="form-control  @error('charity') is-invalid @enderror" name="charity" placeholder="$10.0" value="{{old('charity')}}">        
                                        @error('charity')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="cost_of_vendor">Cost Of Vendor</label>
                                    <input type="number"  required="" id="cost_of_vendor" class="form-control  @error('cost_of_vendor') is-invalid @enderror" name="cost_of_vendor" placeholder="$10.0" value="{{old('cost_of_vendor')}}">        
                                        @error('cost_of_vendor')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="vendor_space_available">Vendor Space Available</label>
                                    <input type="number"  required="" id="vendor_space_available" class="form-control  @error('vendor_space_available') is-invalid @enderror" name="vendor_space_available" placeholder="$10.0" value="{{old('vendor_space_available')}}">        
                                        @error('vendor_space_available')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="vendor_space_available">Vendor Space Available</label>
                                    <input type="number"  required="" id="vendor_space_available" class="form-control  @error('vendor_space_available') is-invalid @enderror" name="vendor_space_available" placeholder="$10.0" value="{{old('vendor_space_available')}}">        
                                        @error('vendor_space_available')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
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

                <div class="card shadow mb-4">
                     <div class="card-body">
                           <div class="form-group">
                             <label for="meta_title">Meta Title</label>
                            <input type="text"  id="meta_title" class="form-control  @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="Meta Title" value="{{old('meta_title')}}">        
                                @error('meta_title')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                            <label for="meta_keyword">Meta Keywords</label>
                            <textarea class="form-control @error('meta_keyword') is-invalid @enderror" id="meta_keyword" placeholder="Meta Keywords" name="meta_keyword">{{old('meta_keyword')}}</textarea>
                            @error('meta_keyword')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            </div>
                            <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" placeholder="Meta Description" name="meta_description">{{old('meta_description')}}</textarea>
                            @error('meta_description')
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
                                <label for="status">Select Status*</label>
                                <select name="status" id="status" required="" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="published" selected>Published</option>
                                    <option value="draft">Draft</option>
                                </select>
                                
                                @error('status')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>                    

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h1 class="h5  text-gray-800 m-0">Featured Image</h1>
                        </div>
                        <div class="card-body">
                            
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
    $('.lfm').filemanager('image', {prefix: route_prefix});
    function removeImage() {
        $('#featured_image').val('');
        $('#lfm').html('Upload')
    }
    let counter = 0;
    function addGalleryImage(){
        $(`<div class="gallery_image">
            <span class="remove" onclick="$(this).parent('.gallery_image').remove()">&times</span>
            <input type="hidden" name="gallery[`+counter+`][url]" id="gallery-`+counter+`" />
            <div class="image lfm" id="lfm-`+counter+`" data-input="gallery-`+counter+`" data-preview="lfm-`+counter+`">
            </div>
            <input type="text" name="gallery[`+counter+`][alt]" value="" placeholder="Alt Text"> 
            </div>
        `).insertBefore('.add_image');
        $('.lfm').filemanager('image', {prefix: route_prefix});
        $(`#lfm-`+counter).trigger('click');
        counter++;
    }
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



