@extends('layouts.admin.app', ['title' => 'Add New Podcast'])
@section('content') 

    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Add New Podcast</h1>

        <form action="{{route('podcasts.store')}}" method="POST" autocomplete="off" class="user">
               @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">Podcast Information</h3>                           
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"  required="" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter Podcast Name*" value="{{old('name')}}">        
                                @error('name')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="title">Sub Heading:</label>
                                <input type="text"  required="" id="subheading" class="form-control  @error('subheading') is-invalid @enderror" name="subheading" placeholder="Enter Sub Heading*" value="{{old('subheading')}}">        
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

                            <div class="form-group ">
                                <label for="itune_link">iTunes Link</label>
                                <input id="itunes_link" class="form-control @error('itunes_link') is-invalid @enderror" type="text" name="itunes_link" value="{{old('itunes_link')}}" placeholder="iTunes Link">
                                @error('itunes_link')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="spotify_link">Spotify Links</label>
                                <input id="spotify_link" class="form-control @error('spotify_link') is-invalid @enderror" type="text" name="spotify_link" value="{{old('spotify_link')}}" placeholder="Spotify Link">
                                @error('itunes_link')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="gm_link">Google Music Link</label>
                                <input id="gm_link" class="form-control @error('gm_link') is-invalid @enderror" type="text" name="gm_link" value="{{old('gm_link')}}" placeholder="Google Music Link">
                                @error('gm_link')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="stitcher_link">Stitcher Link</label>
                                <input id="stitcher_link" class="form-control @error('stitcher_link') is-invalid @enderror" type="text" name="stitcher_link" value="{{old('stitcher_link')}}" placeholder="Stitcher Link">
                                @error('stitcher_link')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="youtube_link">Youtube Link</label>
                                <input id="youtube_link" class="form-control @error('youtube_link') is-invalid @enderror" type="text" name="youtube_link" value="{{old('youtube_link')}}" placeholder="Youtube Link">
                                @error('youtube_link')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                            <div class="form-group ">
                                <label for="pt_message">Additional Message:</label>
                                <textarea id="pt_message" class="form-control @error('pt_message') is-invalid @enderror" type="text" name="pt_message" placeholder="Additional Message"> 
                                    {{ (old('pt_message')) ? old('pt_message') : '' }}
                                </textarea>
                                @error('pt_message')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>                

                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="h5 my-0">Podcast</h3>
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

                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <h3 class="h5 my-0">Uploaded Podcast</h3>
                        </div>
                         <div class="card-body gallery">
                            <div class="podcast_list">
                                <ul id="list_pod">
                                     
                                </ul>
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
                            <div class="form-group">
                                <label for="user_id">Select Author*</label>
                                <select name="user_id" id="user_id" required="" class="form-control">
                                    <option value="">Select Author</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}" {{(auth()->user()->id == $user->id) ? 'selected="selected"' : ''}}>{{$user->name}}</option>
                                    @endforeach
                                </select>
                                
                                @error('user_id')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>                    

                    <!-- @if($categories->count())
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h1 class="h5  text-gray-800 m-0">Categories</h1>
                            </div>
                            <div class="card-body">
                                    @php
                                      $cats = (old('cat')) ? old('cat') : array(); 
                                    @endphp
                                    @foreach($categories as $cat)
                                    <div class="custom-control custom-checkbox small">
                                        <input id="{{ $cat->name }}{{ $cat->id }}" type="checkbox" {{(in_array($cat->id, $cats)) ? 'checked="checked"' : ''}} class=" custom-control-input" name="cat[]" value="{{$cat->id}}">
                                        <label for="{{ $cat->name }}{{ $cat->id }}" class="custom-control-label">{{ $cat->name }}</label>
                                    </div>
                                    <div style="padding-left: 9px;">  
                                        
                                        @foreach($cat->children as $subcat)                                              
                                                <div class="custom-control custom-checkbox small">
                                                    <input id="{{ $subcat->name }}{{ $subcat->id }}" type="checkbox" {{(in_array($subcat->id, $cats)) ? 'checked="checked"' : ''}} class=" custom-control-input" name="cat[]" value="{{$subcat->id}}">
                                                    <label for="{{ $subcat->name }}{{ $subcat->id }}" class="custom-control-label">{{ $subcat->name }}</label>
                                                </div>       
                                                    <div style="padding-left: 9px;">                                 
                                                @foreach($subcat->children as $subcatsub)                                                
                                                        <div class="custom-control custom-checkbox small">
                                                            <input id="{{ $subcatsub->name }}{{ $subcatsub->id }}" type="checkbox" {{(in_array($subcatsub->id, $cats)) ? 'checked="checked"' : ''}} class=" custom-control-input" name="cat[]" value="{{$subcatsub->id}}">
                                                            <label for="{{ $subcatsub->name }}{{ $subcatsub->id }}" class="custom-control-label">{{ $subcatsub->name }}</label>
                                                        </div>
                                                @endforeach
                                                    </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                    @error("cat.*")
                                        {{$message}}
                                    @enderror
                            </div>
                        </div>
                    @endif -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h1 class="h5  text-gray-800 m-0">Featured Image</h1>
                        </div>
                        <div class="card-body">
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


<!-- <script src="{{ asset('/js/admin/selectize.min.js')}}"></script>
<script src="{{ asset('/js/admin/index.js')}}"></script>
<script>
    $('#episode_timeline').selectize({
        persist: false,
        createOnBlur: true,
        create: true
    });
</script> -->

<script>
    var options = {
        filebrowserImageBrowseUrl: '{{ route("unisharp.lfm.show", ["type" => "Images"])}}',
        filebrowserImageUploadUrl: '{{ route("unisharp.lfm.upload", ["type" => "Images", "_token" => ''])}}',
        filebrowserBrowseUrl: '{{ route("unisharp.lfm.show", ["type" => "Files"])}}',
        filebrowserUploadUrl: '{{ route("unisharp.lfm.upload", ["type" => "Files", "_token" => ''])}}'
    };

    $(document).ready(function(){
        CKEDITOR.replace('ckeditor1',  options)
    });
    $(document).ready(function(){
        CKEDITOR.replace('pt_message',  options)
    });

    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('.lfm').filemanager('image', {prefix: route_prefix});
    function removeImage() {
   
        $('#featured_image').val('');
        $('#lfm').html('Upload')
    }
    function removeAudioGallery(target_id) {
        $("#"+target_id).remove();
    }
    let counter = 0;
    function addGalleryImage(){
        $("#list_pod").append(`<li id="galleryAudio_`+counter+`">
    <div class="file_src">
        <label><span>File: </span> <div class="video lfmv" id="lfmv-`+counter+`" data-input="gallery-`+counter+`" data-preview="lfmv-`+counter+`" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
            <i class="fas fa-upload"></i>
        </div>
        </label>
        <input type="hidden" name="gallery[`+counter+`][sort]" value="`+counter+`" />
        <input type="hidden" name="gallery[`+counter+`][url]" id="gallery-`+counter+`" />
        
    </div>
    <div class="remove_audio" onClick="removeAudioGallery('galleryAudio_`+counter+`');">
        <i class="fas fa-times-circle"></i>
    </div>
    <div style="clear:both;"></div>
    <div id="lfmv-`+counter+`-inp"></div>
    <div class="marg_link">
        <label>Tile:
        <input type="text" name="gallery[`+counter+`][alt]" value="" placeholder="Title"></label>
    </div>
</li>`);
       
        $('.lfmv').filemanager('video', {prefix: route_prefix});
        $(`#lfmv-`+counter).trigger('click');
        counter++;
    }
</script>

@endsection



