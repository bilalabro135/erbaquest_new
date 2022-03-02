@extends('layouts.admin.app', ['title' => 'Add New Event'])

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
   
         <h1 class="h3 mb-4 text-gray-800">Add New Event</h1>
         @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
@endphp
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
                                    <!-- <input type="text"  required="" id="type" class="form-control  @error('type') is-invalid @enderror" name="type" placeholder="Enter Event Name*" value="{{old('type')}}">    -->
                                    <select name="type" id="type" required="" class="form-control">
                                        <option value="" selected="selected">Type Of Event</option>
                                        <option value="Type1">Type1</option>
                                        <option value="Type2">type2</option>
                                        <option value="Type3">Type3</option>
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
                                    <input type="number"  required="" id="vendor_space_available" class="form-control  @error('vendor_space_available') is-invalid @enderror" name="vendor_space_available" placeholder="10" value="{{old('vendor_space_available')}}">        
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
                                        <option value="" selected="selected">Select Location</option>
                                        @foreach($countries as $country)
                                            <option value="{{$country}}">{{$country}}</option>
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
                                    <!-- <input type="number"  required="" id="height" class="form-control  @error('height') is-invalid @enderror" name="height" placeholder="$10.0" value="{{old('height')}}"> -->   


                                    <select name="height" id="height" required="" class="form-control">
                                        <option value="" selected="selected">Select Height</option>
                                        <option value="10">10ft</option>
                                        <option value="100">100ft</option>
                                        <option value="500">500ft</option>
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
                                        <option value="" selected="selected">Select Capactiy</option>
                                        <option value="Capacity1">Capacity1</option>
                                        <option value="Capacity2">Capacity2</option>
                                        <option value="Capacity3">Capacity3</option>
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
                                        <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
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
                                    <input type="number"  required="" id="tickiting_number" class="form-control  @error('tickiting_number') is-invalid @enderror" name="tickiting_number" placeholder="$10.0" value="{{old('tickiting_number')}}">        
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
                                    <input type="tel"  required="" id="vendor_number" class="form-control  @error('vendor_number') is-invalid @enderror" name="vendor_number" placeholder="+1 234 567 890" value="{{old('vendor_number')}}">        
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
                                    <input type="tel"  required="" id="user_number" class="form-control  @error('user_number') is-invalid @enderror" name="user_number" placeholder="+1 234 567 890" value="{{old('user_number')}}">        
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
                                    <input type="url"  required="" id="website_link" class="form-control  @error('website_link') is-invalid @enderror" name="website_link" placeholder="http://" value="{{old('website_link')}}">        
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
                                    <input type="url"  required="" id="facebook" class="form-control  @error('facebook') is-invalid @enderror" name="facebook" placeholder="http://" value="{{old('facebook')}}">        
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
                                    <input type="url"  required="" id="twitter" class="form-control  @error('twitter') is-invalid @enderror" name="twitter" placeholder="http://" value="{{old('twitter')}}">        
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
                                    <input type="url"  required="" id="linkedin" class="form-control  @error('linkedin') is-invalid @enderror" name="linkedin" placeholder="http://" value="{{old('linkedin')}}">        
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
                                    <input type="url"  required="" id="instagram" class="form-control  @error('instagram') is-invalid @enderror" name="instagram" placeholder="http://" value="{{old('instagram')}}">        
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
                                    <input type="url"  required="" id="youtube" class="form-control  @error('youtube') is-invalid @enderror" name="youtube" placeholder="http://" value="{{old('youtube')}}">        
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
                            <textarea class=" form-control @error('description') is-invalid @enderror" id="ckeditor1" placeholder="Description"  name="description">{{old('description')}} </textarea>
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                           <h3 class="h5 my-0">Ammenities</h3>                           
                        </div>
                        <div class="card-body">
                            @foreach($amenities as $amenity)
                                <div class="custom-control custom-checkbox small">
                                    <input id="{{ $amenity->name }}{{ $amenity->id }}" type="checkbox" class=" custom-control-input" name="amenities[]" value="{{$amenity->id}}">
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
                                <label for="user_id">Select Organizer*</label>
                                <select name="user_id" id="user_id" required="" class="form-control">
                                    <option value="">Select Organizer</option>
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
                            <div class="form-group">
                                <label for="vendor">Select Vendor</label>
                                <select name="vendors[]" id="vendors" class="form-control" multiple="">
                                    @foreach($vendors as $vendor)
                                        <option value="{{$vendor->id}}" {{(auth()->user()->id == $vendor->id) ? 'selected="selected"' : ''}}>{{$vendor->name}}</option>
                                    @endforeach
                                </select>
                                
                                @error('vendor')
                                    <div class="text-danger">
                                        {{$message}}                                            
                                    </div>
                                @endif
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
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

<script type="text/javascript" src="{{asset('/js/admin/select2.min.js')}}"></script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBqcEwYN_Z-npfhF10ZUpdqyIXtfkSN1bg&libraries=places&callback=initMap">
</script>

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

    $(document).ready(function() {
        $('#vendors').select2();
    });
</script>
@endsection



