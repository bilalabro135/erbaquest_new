
@extends('layouts.admin.app', ['title' => 'Edit Event'])

@section('head')
<link rel="stylesheet" type="text/css" href="{{asset('/css/admin/select2.min.css')}}">
@endsection


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

                                    <div class="form-group custom-control custom-checkbox small is_recurring">
                                        <input @if($event->is_recurring) checked="checked" @endif type="checkbox"  id="is_recurring" class="custom-control-input"  name="is_recurring" value="1">
                                        <label for="is_recurring" class="custom-control-label">Is Recurring?</label>
                                    </div>

                                    <div class="form-group">
                                    <label for="event_date">Event Date</label>
                                    <input @if($event->is_recurring) disabled="disabled" @endif type="date"  required="" id="event_date" class="form-control  @error('event_date') is-invalid @enderror" name="event_date" placeholder="Enter Event Name*" value="{{ (old('event_date')) ? old('event_date') : $event->event_date }}">
                                        @error('event_date')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                    <label for="type">Type Of Event</label>
                                    <!-- <input type="text"  required="" id="type" class="form-control  @error('type') is-invalid @enderror" name="type" placeholder="Enter Event Name*" value="{{old('type')}}">    -->

                                    <select name="type" required="required" class="form-control">
                                        <option selected="selected">Type:</option>
                                        @foreach($tyoesOfEvents as $tyoesOfEvent)
                                        <option value="{{$tyoesOfEvent['name']}}" {{(isset($event->type) && $event->type == $tyoesOfEvent['name']) ? 'selected="selected"' : ''}}>{{$tyoesOfEvent['name']}}</option>
                                        @endforeach
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
                                        <input type="hidden" id="featured_image" value="{{asset($event->featured_image)}}" name="featured_image">
                                        <div class="file-upload" id="lfm" data-input="featured_image" data-preview="lfm" >
                                            @empty($event->featured_image)
                                                Upload Image
                                            @else
                                                 <img src="{{asset($event->featured_image)}}" style="height: 5rem;">
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
                                <div class="col-sm-12 col-md-6 recurring_component">
                                    <label>Days Dropdown: {{ $event->day_dropdown  }}</label>
                                    <select name="day" id="day" required="" class="form-control">
                                        <option value="monday" @if($event->day_dropdown == 'monday') selected="selected" @endif>Monday</option>
                                        <option value="tuesday" @if($event->day_dropdown == 'tuesday') selected="selected" @endif>Tuesday</option>
                                        <option value="wednesday" @if($event->day_dropdown == 'wednesday') selected="selected" @endif>Wednesday</option>
                                        <option value="thursday" @if($event->day_dropdown == 'thursday') selected="selected" @endif>Thursday</option>
                                        <option value="friday" @if($event->day_dropdown == 'friday') selected="selected" @endif>Friday</option>
                                        <option value="saturday" @if($event->day_dropdown == 'saturday') selected="selected" @endif >Saturday</option>
                                        <option value="sunday" @if($event->day_dropdown == 'sunday') selected="selected" @endif >Sunday</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-6 recurring_component">
                                    <label>Recurring Type:</label>
                                    <select name="recurring_type" id="recurring_type" required="" class="form-control">
                                        <option value="weekly" @if($event->recurring_type == 'weekly') selected="selected" @endif>Weekly</option>
                                        <option value="monthly" @if($event->recurring_type == 'monthly') selected="selected" @endif >Monthly</option>
                                        <option value="yearly" @if($event->recurring_type == 'yearly') selected="selected" @endif>Yearly</option>
                                    </select>
                                </div>

                                <br>
                                <br>
                                <br>
                                <br>

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
                                                        <input type="hidden" name="gallery[{{$key}}][url]" id="gallery-{{$key}}" value="{{(isset($image['url'])) ? asset($image['url']) : ''}}" />
                                                        <div class="image lfm" id="lfm-{{$key}}" data-input="gallery-{{$key}}" data-preview="lfm-{{$key}}">
                                                            <img src="{{(isset($image['url'])) ? asset($image['url']) : ''}}" style="height: 5rem;">
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
                                    <input type="text"  required="" id="vip_perk" class="form-control  @error('vip_perk') is-invalid @enderror" name="vip_perk" placeholder="$10.0" value="{{ (old('vip_perk')) ? old('vip_perk') : $event->vip_perk }}">
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
                                    <input type="text"  required="" id="charity" class="form-control  @error('charity') is-invalid @enderror" name="charity" placeholder="$10.0" value="{{ (old('charity')) ? old('charity') : $event->charity }}">
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
                                        <option value=""></option>
                                        @foreach($countries as $country)
                                            <option value="{{$country->name}}" {{(isset($event->area) && $event->area == $country->name) ? 'selected="selected"' : ''}}>{{$country->name}}</option>
                                        @endforeach
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
                                    <input type="text" name="height" id="height" class="form-control" value="{{ $event->height }}" required="required">
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
                                    <input type="number" name="capacity" id="capacity" class="form-control" required="required" value="{{ $event->capacity }}">
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
                                    <input type="number"  required="" id="vendor_number" class="form-control  @error('vendor_number') is-invalid @enderror" name="vendor_number" placeholder="+1 234 567 890" value="{{ (old('vendor_number')) ? old('vendor_number') : $event->vendor_number }}">
                                        @error('vendor_number')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="user_number">User Number</label>
                                    <input type="tel"  required="" id="user_number" class="form-control  @error('user_number') is-invalid @enderror" name="user_number" placeholder="+1 234 567 890" value="{{ (old('user_number')) ? old('user_number') : $event->user_number }}">
                                        @error('user_number')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @endif
                                    </div>
                                </div> -->
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
                                <div class="col-sm-12 col-md-4">
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
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="telegram">Telegram</label>
                                    <input type="url"  required="" id="telegram" class="form-control  @error('telegram') is-invalid @enderror" name="telegram" placeholder="http://" value="{{ (old('telegram')) ? old('telegram') : $event->telegram }}">
                                        @error('telegram')
                                            <div class="text-danger">
                                                {{$message}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group">
                                    <label for="discord">Discord</label>
                                    <input type="url"  required="" id="discord" class="form-control  @error('discord') is-invalid @enderror" name="discord" placeholder="http://" value="{{ (old('discord')) ? old('discord') : $event->discord }}">
                                        @error('discord')
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
                    @if(count($amenities))
                    @php
                        $eamenities = $event->amenities;
                        $amenity_ids = array();
                        foreach ($eamenities as $amenity):
                            $amenity_ids[] = $amenity->id;
                        endforeach;
                    @endphp
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">Ammenities</h3>
                        </div>
                        <div class="card-body">
                            @foreach($amenities as $amenity)
                                <div class="custom-control custom-checkbox small">
                                    <input id="{{ $amenity->name }}{{ $amenity->id }}" type="checkbox" class=" custom-control-input" name="amenities[]" {{(in_array($amenity->id, $amenity_ids)) ? 'checked="checked"' : ''}} value="{{$amenity->id}}">
                                    <label for="{{ $amenity->name }}{{ $amenity->id }}" class="custom-control-label">{{ $amenity->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
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
                                <label for="user_id">Select Organizer*</label>
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
                            @php
                                $evendors = $event->vendors;
                                $vendor_ids = array();
                                foreach ($evendors as $evendor):
                                    $vendor_ids[] = $evendor->id;
                                endforeach;
                            @endphp
                            <div class="form-group">
                                <label for="vendor">Select Vendor</label>
                                <select name="vendors[]" id="vendors" class="form-control" multiple="">
                                    @if($vendorProfiles)
                                        @foreach($vendorProfiles as $vendorProfile)
                                            <option value="{{$vendorProfile['id']}}" {{(auth()->user()->id == $vendorProfile['id']) ? 'selected="selected"' : ''}}>{{$vendorProfile['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                @error('vendor')
                                    <div class="text-danger">
                                        {{$message}}
                                    </div>
                                @endif
                                <div class="main_event">
                                    <label>
                                    <input type="checkbox" @if($event->featured) checked="checked"  @endif name="featured" value="1">
                                    <span>
                                        Featured
                                    </span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- event review -->
                @if($sendReviews)
                    <div class="col-md-12">
                        <div class="alert-success success review_sucess">
                            Review has been removed!
                        </div>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Reviews On Vendors</h6>
                            </div>
                                <div class="card-body">
                                @foreach($sendReviews as $sendReview)
                                    <div class="card_reviews" id="comment_{{ $sendReview['id'] }}">
                                        <div class="profilePicture">
                                            @if(!empty($sendReview['profile_image']))
                                                <img src="{{ $sendReview['profile_image'] }}" >
                                              @else
                                                <img src="{{asset('images/avatar.png')}}">
                                              @endif
                                        </div>
                                        <div class="profile_info">
                                            <div class="profile_name">{{ $sendReview['name'] }}</div>
                                            <div class="date">{{ $sendReview['date'] }}</div>
                                            <div class="rating_Set">
                                                <div class="rating_speed">
                                                    <h5>Speed</h5>
                                                   <ul>
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if($i >= $sendReview['speed_rating'])
                                                            <li><i class="far fa-star"></i></li> <!-- kali -->
                                                        @else
                                                            <li><i class="fas fa-star"></i></li>
                                                        @endif
                                                    @endfor
                                                       <div style="clear: both;"></div>
                                                   </ul>
                                                   <div style="clear: both;"></div>
                                               </div>
                                               <div class="rating_speed">
                                                    <h5>Quality:</h5>
                                                   <ul>
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if($i >= $sendReview['quality_rating'])
                                                            <li><i class="far fa-star"></i></li> <!-- kali -->
                                                        @else
                                                            <li><i class="fas fa-star"></i></li>
                                                        @endif
                                                    @endfor
                                                       <div style="clear: both;"></div>
                                                   </ul>
                                                   <div style="clear: both;"></div>
                                               </div>
                                               <div class="rating_speed">
                                                    <h5>Price:</h5>
                                                   <ul>
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if($i >= $sendReview['price_rating'])
                                                            <li><i class="far fa-star"></i></li> <!-- kali -->
                                                        @else
                                                            <li><i class="fas fa-star"></i></li>
                                                        @endif
                                                    @endfor
                                                       <div style="clear: both;"></div>
                                                   </ul>
                                                   <div style="clear: both;"></div>
                                               </div>
                                               <div style="clear: both;"></div>
                                            </div>

                                            <div style="clear: both;"></div>
                                            <div class="person_desc">
                                                <p id="parah_comment_{{ $sendReview['id'] }}" class="ondelete">{{ $sendReview['comment'] }}</p>
                                                <textarea id="textarea_{{ $sendReview['id'] }}" class="onsubmit">{{ $sendReview['comment'] }}</textarea>

                                            </div>
                                            <div class="action_set">
                                                <ul>
                                                    <li class="ondelete">
                                                        <a class="edittextarea" href="javascript:void(0);">Edit</a>
                                                    </li>
                                                    <li class="onsubmit">
                                                        <a class="submit_func"  data-vendorid="{{ $sendReview['id'] }}" href="javascript:void(0);">Submit</a>
                                                    </li>
                                                    <li class="ondelete">
                                                        <a data-vendorid="{{ $sendReview['id'] }}" class="delete_func" href="javascript:void(0);">Delete</a>
                                                    </li>
                                                    <li class="onsubmit">
                                                        <a class="cancelButton" href="javascript:void(0);">Cancel</a>
                                                    </li>
                                                    <div style="clear: both;"></div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div style="clear: both;"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/admin/select2.min.js')}}"></script>


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
    let counter = {{$count}};
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
            $(document).ready(function() {
        $('#vendors').select2();
    });
</script>
<script type="text/javascript">
    $(".delete_func").click(function() {
        if (confirm('Are you sure?')) {
            var comment_id = $(this).data("vendorid");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
               type:'POST',
               url: '{{route("comment.delete")}}',
               data:'comment_id='+comment_id,
               success:function() {
                  $("#comment_"+comment_id).remove();
                  $(".review_sucess").show();
                  $(".review_sucess").delay("slow").fadeOut();
               }
            });
        }
    });

    $(".submit_func").click(function(){
        var comment_id = $(this).data("vendorid");
        var comment = $("#textarea_"+comment_id).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           type:'POST',
           url: '{{route("comment.submit")}}',
           data:'comment_id='+comment_id+"&comment="+comment,
           success:function() {
              $(".onsubmit").hide();
              $(".ondelete").show();
              $("#parah_comment_"+comment_id).text(comment);
           }
        });
    });
    $(".edittextarea").click(function() {
        var thisfolder = $(this).parent("li").parent("ul").parent(".action_set").parent(".profile_info");
        thisfolder.find(".person_desc p").hide();
        thisfolder.find(".person_desc textarea").show();
        thisfolder.find(".onsubmit").show();
        thisfolder.find(".ondelete").hide();
    });
    $(".cancelButton").click(function() {
        var thisfolder = $(this).parent("li").parent("ul").parent(".action_set").parent(".profile_info");
        thisfolder.find(".onsubmit").hide();
        thisfolder.find(".ondelete").show();
    });
</script>

<style>
    .is_recurring .input-field.input-checkbox label:before{
        position: initial !important;
        margin-right: 11px;
    }
</style>

@if(!$event->is_recurring)
    <style>
        .recurring_component{
            display: none;
        }
    </style>
@endif
<script>
    $(document).ready(function (){
        $(".is_recurring input").click(function (){
            if($('#is_recurring').is(":checked")){
                $(".recurring_component").show();
                $("#event_date").prop( "disabled", true );
            }else{
                $(".recurring_component").hide();
                $("#event_date").prop( "disabled", false );
            }
        });
    });
</script>
@endsection



