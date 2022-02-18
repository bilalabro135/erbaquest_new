
@extends('layouts.admin.app', ['title' => 'Edit Event'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
   
         <h1 class="h3 mb-4 text-gray-800">Edit Event</h1>

        <form action="{{route('events.update', ['event'=> request('event') ])}}" method="POST" autocomplete="off" class="user">
            <input type="hidden" name="old_slug" value="{{$event->slug}}">
               @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">event Information</h3>                           
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text"  required="" id="name" class="form-control  @error('name') is-invalid @enderror" name="name" placeholder="Enter event Name*" value="{{ (old('name')) ? old('name') : $event->name }}">        
                                        @error('name')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="slug">Slug</label>
                                    <input type="text" required="" class="form-control @error('slug') is-invalid @enderror" id="slug" aria-describedby="slug" placeholder="Enter event Slug" name="slug" value="{{ (old('slug')) ? old('slug') : $event->slug }}">
                                    @error('slug')
                                        <div class="text-danger">
                                            {{$message}}                                            
                                        </div>
                                    @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="event_date">Event Date</label>
                                    <input type="date"  required="" id="event_date" class="form-control  @error('event_date') is-invalid @enderror" name="event_date" placeholder="Enter Event Name*" value="{{ (old('event_date')) ? old('event_date') : $event->event_date }}">       
                                        @error('event_date')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="type">Type Of Event</label>
                                    <!-- <input type="text"  required="" id="type" class="form-control  @error('type') is-invalid @enderror" name="type" placeholder="Enter Event Name*" value="{{old('type')}}">    -->
                                    <select name="type" id="type" required="" class="form-control">
                                        <option value="" selected="selected" {{(isset($event->type) && $event->type == "") ? 'selected="selected"' : ''}}>Type Of Event</option>
                                        <option value="Type1" {{(isset($event->type) && $event->type == "Type1") ? 'selected="selected"' : ''}}>Type1</option>
                                        <option value="Type2" {{(isset($event->type) && $event->type == "Type2") ? 'selected="selected"' : ''}}>type2</option>
                                        <option value="Type3" {{(isset($event->type) && $event->type == "Type3") ? 'selected="selected"' : ''}}>Type3</option>
                                    </select>      
                                        @error('type')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="featured_image">Featured Image</label>
                                        <input type="hidden" id="featured_image" value="{{$event->featured_image}}" name="featured_image">
                                        <div class="file-upload" id="lfm" data-input="featured_image" data-preview="lfm" >
                                            @empty($event->featured_image)
                                                Upload Image
                                            @else
                                                 <img src="{{$event->featured_image}}" style="height: 5rem;">
                                            @endif
                                           
                                        </div>
                                    @error('featured_image')
                                        <div class="text-danger">
                                            {{$message}}                                            
                                        </div>
                                    @endif
                                    <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="card shadow mb-4">
                                        <div class="card-header">
                                            <h3 class="h5 my-0">Gallery</h3>
                                        </div>
                                         <div class="card-body gallery">
                                            <div class="gallery_images">
                                                @php 
                                                    $count = 0;
                                                        $images = (!empty($event->gallery)) ? unserialize($event->gallery) : array();
                                                    @endphp
                                                    @foreach($images as $key => $image)
                                                    <div class="gallery_image">
                                                        <span class="remove" onclick="$(this).parent('.gallery_image').remove()">&times</span>
                                                        <input type="hidden" name="gallery[{{$key}}][url]" id="gallery-{{$key}}" value="{{(isset($image['url'])) ? $image['url'] : ''}}" />
                                                        <div class="image lfm" id="lfm-{{$key}}" data-input="gallery-{{$key}}" data-preview="lfm-{{$key}}">
                                                            <img src="{{(isset($image['url'])) ? $image['url'] : ''}}" style="height: 5rem;">
                                                        </div>
                                                        <input type="text" name="gallery[{{$key}}][alt]" value="{{(isset($image['url'])) ? $image['alt'] : ''}}" placeholder="Alt Text"> 
                                                    </div>
                                                    @php
                                                       $count = $key; 
                                                    @endphp
                                                @endforeach
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
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text"  required="" id="address" class="form-control  @error('address') is-invalid @enderror" name="address" placeholder="Address" value="{{ (old('address')) ? old('address') : $event->address }}">        
                                        @error('address')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                    <label for="door_dontation">EXPECTED DOOR DONATION</label>
                                    <input type="number"  required="" id="door_dontation" class="form-control  @error('door_dontation') is-invalid @enderror" name="door_dontation" placeholder="$100.00" value="{{ (old('door_dontation')) ? old('door_dontation') : $event->door_dontation }}">        
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
                                    <input type="number"  required="" id="vip_dontation" class="form-control  @error('vip_dontation') is-invalid @enderror" name="vip_dontation" placeholder="$10.0" value="{{ (old('vip_dontation')) ? old('vip_dontation') : $event->vip_dontation }}">        
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
                                    <input type="number"  required="" id="vip_perk" class="form-control  @error('vip_perk') is-invalid @enderror" name="vip_perk" placeholder="$10.0" value="{{ (old('vip_perk')) ? old('vip_perk') : $event->vip_perk }}">        
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
                                    <input type="number"  required="" id="charity" class="form-control  @error('charity') is-invalid @enderror" name="charity" placeholder="$10.0" value="{{ (old('charity')) ? old('charity') : $event->charity }}">        
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
                                    <input type="number"  required="" id="cost_of_vendor" class="form-control  @error('cost_of_vendor') is-invalid @enderror" name="cost_of_vendor" placeholder="$10.0" value="{{ (old('cost_of_vendor')) ? old('cost_of_vendor') : $event->cost_of_vendor }}">        
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
                                    <input type="number"  required="" id="vendor_space_available" class="form-control  @error('vendor_space_available') is-invalid @enderror" name="vendor_space_available" placeholder="10" value="{{ (old('vendor_space_available')) ? old('vendor_space_available') : $event->vendor_space_available }}">        
                                        @error('vendor_space_available')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="area">Area</label>
                                    <!-- <input type="number"  required="" id="area" class="form-control  @error('area') is-invalid @enderror" name="area" placeholder="$10.0" value="{{old('area')}}">  --> 

                                    <select name="area" id="area" required="" class="form-control">
                                        <option value="" selected="selected" {{(isset($event->area) && $event->area == "") ? 'selected="selected"' : ''}}>Select Area</option>
                                        <option value="Area1" {{(isset($event->area) && $event->area == "Area1") ? 'selected="selected"' : ''}}>Area1</option>
                                        <option value="Area2" {{(isset($event->area) && $event->area == "Area2") ? 'selected="selected"' : ''}}>Area2</option>
                                        <option value="Area3" {{(isset($event->area) && $event->area == "Area3") ? 'selected="selected"' : ''}}>Area3</option>
                                    </select> 

                                        @error('area')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="height">Height</label>
                                    <!-- <input type="number"  required="" id="height" class="form-control  @error('height') is-invalid @enderror" name="height" placeholder="$10.0" value="{{old('height')}}"> -->   


                                    <select name="height" id="height" required="" class="form-control">
                                        <option value="" selected="selected" {{(isset($event->height) && $event->height == "") ? 'selected="selected"' : ''}}>Select Height</option>
                                        <option value="10" {{(isset($event->height) && $event->height == "10") ? 'selected="selected"' : ''}}>10ft</option>
                                        <option value="100" {{(isset($event->height) && $event->height == "100") ? 'selected="selected"' : ''}}>100ft</option>
                                        <option value="500" {{(isset($event->height) && $event->height == "500") ? 'selected="selected"' : ''}}>500ft</option>
                                    </select> 

                                        @error('height')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="capacity">Capacity</label>
                                    <!-- <input type="number"  required="" id="capacity" class="form-control  @error('capacity') is-invalid @enderror" name="capacity" placeholder="$10.0" value="{{old('capacity')}}">   -->   

                                    <select name="capacity" id="capacity" required="" class="form-control">
                                        <option value="" selected="selected" {{(isset($event->capacity) && $event->capacity == "") ? 'selected="selected"' : ''}}>Select Capactiy</option>
                                        <option value="Capacity1" {{(isset($event->capacity) && $event->capacity == "Capacity1") ? 'selected="selected"' : ''}}>Capacity1</option>
                                        <option value="Capacity2" {{(isset($event->capacity) && $event->capacity == "Capacity2") ? 'selected="selected"' : ''}}>Capacity2</option>
                                        <option value="Capacity3" {{(isset($event->capacity) && $event->capacity == "Capacity3") ? 'selected="selected"' : ''}}>Capacity3</option>
                                    </select> 

                                        @error('capacity')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="ATM_on_site">ATM On Site</label>
                                    <!-- <input type="number"  required="" id="ATM_on_site" class="form-control  @error('ATM_on_site') is-invalid @enderror" name="ATM_on_site" placeholder="$10.0" value="{{old('ATM_on_site')}}">  -->

                                    <select name="ATM_on_site" id="ATM_on_site" required="" class="form-control">
                                        <option value="Yes" selected {{(isset($event->ATM_on_site) && $event->ATM_on_site == "Yes") ? 'selected="selected"' : ''}}>Yes</option>
                                        <option value="No" {{(isset($event->ATM_on_site) && $event->ATM_on_site == "No") ? 'selected="selected"' : ''}}>No</option>
                                    </select> 

                                        @error('ATM_on_site')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="tickiting_number">Tickiting Number</label>
                                    <input type="number"  required="" id="tickiting_number" class="form-control  @error('tickiting_number') is-invalid @enderror" name="tickiting_number" placeholder="$10.0" value="{{ (old('tickiting_number')) ? old('tickiting_number') : $event->tickiting_number }}">        
                                        @error('tickiting_number')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="vendor_number">Vendor Number</label>
                                    <input type="tel"  required="" id="vendor_number" class="form-control  @error('vendor_number') is-invalid @enderror" name="vendor_number" placeholder="+1 234 567 890" value="{{ (old('vendor_number')) ? old('vendor_number') : $event->vendor_number }}">        
                                        @error('vendor_number')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="user_number">User Number</label>
                                    <input type="tel"  required="" id="user_number" class="form-control  @error('user_number') is-invalid @enderror" name="user_number" placeholder="+1 234 567 890" value="{{ (old('user_number')) ? old('user_number') : $event->user_number }}">        
                                        @error('user_number')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="website_link">Website Link</label>
                                    <input type="url"  required="" id="website_link" class="form-control  @error('website_link') is-invalid @enderror" name="website_link" placeholder="http://" value="{{ (old('website_link')) ? old('website_link') : $event->website_link }}">        
                                        @error('website_link')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="url"  required="" id="facebook" class="form-control  @error('facebook') is-invalid @enderror" name="facebook" placeholder="http://" value="{{ (old('facebook')) ? old('facebook') : $event->facebook }}">        
                                        @error('facebook')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="url"  required="" id="twitter" class="form-control  @error('twitter') is-invalid @enderror" name="twitter" placeholder="http://" value="{{ (old('twitter')) ? old('twitter') : $event->twitter }}">        
                                        @error('twitter')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="url"  required="" id="linkedin" class="form-control  @error('linkedin') is-invalid @enderror" name="linkedin" placeholder="http://" value="{{ (old('linkedin')) ? old('linkedin') : $event->linkedin }}">        
                                        @error('linkedin')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="url"  required="" id="instagram" class="form-control  @error('instagram') is-invalid @enderror" name="instagram" placeholder="http://" value="{{ (old('instagram')) ? old('instagram') : $event->instagram }}">        
                                        @error('instagram')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label for="youtube">Youtube</label>
                                    <input type="url"  required="" id="youtube" class="form-control  @error('youtube') is-invalid @enderror" name="youtube" placeholder="http://" value="{{ (old('youtube')) ? old('youtube') : $event->youtube }}">        
                                        @error('youtube')
                                            <div class="text-danger">
                                                {{$message}}                                            
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            

                            <div class="form-group">
                            <label for="ckeditor1">Description</label>
                            <textarea class=" form-control @error('description') is-invalid @enderror" id="ckeditor1" placeholder="Description"  name="description">{{ (old('description')) ? old('description') : $event->description }}</textarea>
                            @error('description')
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
                                    <option value="published" {{ ($event->status == 'published') ? 'selected="selected"' : ''}} >Published</option>
                                    <option {{ ($event->status == 'draft') ? 'selected="selected"' : ''}} value="draft">Draft</option>
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
                                        <option value="{{$user->id}}" {{($user->id == $event->user_id) ? 'selected="selected"' : '' }} >{{$user->name}}</option>
                                    @endforeach
                                </select>
                                
                                @error('user_id')
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
    function removeImage() {
        $('#featured_image').val('');
        $('#lfm').html('Upload Image')
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



