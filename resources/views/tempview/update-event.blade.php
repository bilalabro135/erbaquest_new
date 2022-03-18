@extends('layouts.front.app')

@section('content')
  @if(isset($pages) && isset($pages->featured_image))
    <x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
  @endif
    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          EDIT EVENT
        </h1>
      </div>
    </section>

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

    <section class="event-inner createEvent pt-100 pb-100">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="createEventForm margin-tb">
              <form class="front_event_update" action="{{ route('front.events.frontupdate', $data->id) }}" method="post" enctype="multipart/form-data">
              <!-- <form class="front_event_create" action="{{route('front.events.store')}}" method="POST" enctype="multipart/form-data"> -->
                <?php //echo"<pre>";print_r($data); ?>
                @csrf
                <input type="hidden" name="checkevent" value="update">
                <div class="row">
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>NAME OF QUEST:</label>
                    <input type="text" name="name" placeholder="NAME:" required="required" value="{{ $data->name }}">
                    @error('name')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file">
                    <label>FEATURED PICTURE: 
                      <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span>
                      <div class="preview">
                        @if($data->featured_image)
                        <img id="preview_img" src="{{asset($data->featured_image)}}">
                        @else
                        <img id="preview_img" src="">
                        @endif
                      </div>
                    </label>
                    <input type="file" id="myFile" name="featured_image" class="upload_file" value="{{ $data->featured_image }}">
                    <button type="button" class="upload_img_btn" id="uploadImg">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    @error('featured_image')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 input-field">
                    <label>DESCRIPTION:</label>
                    <!-- <textarea name="description" placeholder="DESCRIPTION..">{{ $data->description }}</textarea> -->
                    {!! Form::textarea('description', null, array('placeholder' => 'DESCRIPTION..','rows'=>5, 'class' => 'form-control')) !!}

                    @error('description')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file">
                    <label>PICTURE: 
                      <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span>
                      <div class="preview1">
                        @if($data->gallery)
                        <img id="preview_img" src="{{asset($data->gallery)}}">
                        @else
                        <img id="preview_img" src="">
                        @endif
                      </div>
                    </label>
                    <input type="file" id="myFile1" name="gallery[]" class="upload_file" value="{{ $data->gallery }}" multiple>
                    <button type="button" class="upload_img_btn" id="uploadImg1">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    @error('gallery')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-date">
                    <label>DATE:</label>
                    <input type="date" name="event_date" value="{{ $data->event_date }}">
                    @error('event_date')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="input-field input-locate">
                        <label for="pac-input">Address:</label>
                        <input id="edit_pac-input" class="form-control mb-3 " name="map_address" type="text" placeholder="Enter a location" required="required"/>
                        <div id="edit_googlemap" style="height: 300px"></div>
                        <input type="hidden" name="latitude" id="edit_latitude">
                        <input type="hidden" name="longitude" id="edit_longitude">
                        <div id="edit_infowindow-content">
                          <span id="edit_place-name" class="title"></span><br />
                          <span id="edit_place-address"></span>
                        </div>
                        @error('latitude')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                        @endif
                        @error('longitude')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                        @endif
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 customDropdown input-field">
                    <label>TYPE OF EVENT:</label>
                    <select name="type">
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
                    <div class="donation">
                      <div class="input-field input-full">
                        <label>EXPECTED DOOR DONATION:</label>
                        <input type="text" name="door_dontation" placeholder="$10.0" required="required" value="{{ $data->door_dontation }}">
                        @error('door_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP DONATION:</label>
                        <input type="text" name="vip_dontation" placeholder="$500.0" required="required" value="{{ $data->vip_dontation }}">
                        @error('vip_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP PERKS:</label>
                        <input type="text" name="vip_perk" placeholder="$50.0" required="required" value="{{ $data->vip_perk }}">
                        @error('vip_perk')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>CHARITY:</label>
                        <input type="text" name="charity" placeholder="$10.0" required="required" value="{{ $data->charity }}">
                        @error('charity')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>COST TO VEND:</label>
                        <input type="text" name="cost_of_vendor" placeholder="$30.0" required="required" value="{{ $data->cost_of_vendor }}">
                        @error('cost_of_vendor')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>VENDOR:</label>
                    <input type="text" class="vendor_list" name="vendor_list" placeholder="VENDOR:" readonly="readonly" value="{{ $data->vendor_list }}">
                    @error('vendor_list')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                    <div class="VendorList">
                      <ul>
                        @foreach($vendors as $vendor)
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{$vendor->icon}}"></span>{{$vendor->name}}
                              <input id="vendor_{{$vendor->id}}" type="checkbox" data-name="{{$vendor->name}}" name="vendors[]" value="{{$vendor->id}}" required="required" onclick="myVendorsTags('vendor_{{$vendor->id}}');">
                            </label>
                          </div>
                        </li>
                        @endforeach
                        @error('vendor')
                          <div class="text-danger">
                              {{$message}}                                            
                          </div>
                        @endif
                      </ul>
                      <p>Can’t find vendor? <a href="javascript:;">ASK to join</a> </p>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field inputTags">
                    <ul class="vendorTags">
                      <!-- <li>
                        <span>Lorem Ipsum</span> <i class="fas fa-times"></i>
                      </li> -->
                      <!-- <li>
                        Lorem Ipsum <i class="fas fa-times"></i>
                      </li>
                      <li>
                        Lorem Ipsum <i class="fas fa-times"></i>
                      </li>
                      <li>
                        Lorem Ipsum <i class="fas fa-times"></i>
                      </li> -->
                    </ul>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR SPACES AVAILABLE:</label>
                    <input type="number" name="vendor_space_available" value="1" value="{{ $data->vendor_space_available }}">
                    @error('vendor_space_available')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                   @if(count($amenities))
                  <div class="col-sm-12">
                    <h4>AMENTIES:</h4>
                    <div class="AmentieList">
                      <ul>
                        @foreach($amenities as $amenity)
                        <li>
                          <div class="input-field input-checkbox checkRight">
                            <label>
                              <span class="figure"><img src="{{ $amenity->icon }}"></span>{{ $amenity->name }}
                              <input id="{{ $amenity->name }}{{ $amenity->id }}" type="checkbox" name="amenities[]" value="{{$amenity->id}}" required="required">
                            </label>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  @endif

                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>AREA:</label>
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
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>HEIGHT:</label>
                    <input type="text" name="height" value="{{ $data->height }}" placeholder="100ft" required="required">
                    @error('height')
                      <div class="text-danger">
                          {{$message}}                                            
                      </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>CAPACITY:</label>
                    <input type="number" name="capacity" value="{{ $data->capacity }}" placeholder="Capacity">
                    @error('capacity')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>ATM ON SITE:</label>
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
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TICKETING NUMBER:</label>
                    <input type="text" name="tickiting_number" placeholder="Ticket Number:" value="{{ $data->tickiting_number }}">
                    @error('tickiting_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR NUMBER:</label>
                    <input type="text" name="vendor_number" placeholder="Vendor Number:" value="{{ $data->vendor_number }}">
                    @error('vendor_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>USER NUMBER:</label>
                    <input type="text" name="user_number" placeholder="User Number:" value="{{ $data->user_number }}" >
                    @error('user_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>WEBSITE LINK:</label>
                    <input type="url" name="website_link" placeholder="http://" value="{{ $data->website_link }}">
                    @error('website_link')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>FACEBOOK LINK:</label>
                    <input type="url" name="facebook" placeholder="http://" value="{{ $data->facebook }}">
                    @error('facebook')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TWITTER LINK:</label>
                    <input type="url" name="twitter" placeholder="http://"  value="{{ $data->twitter }}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>LINKEDIN LINK:</label>
                    <input type="url" name="linkedin" placeholder="http://" value="{{ $data->linkedin }}">
                    @error('linkedin')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>INSTAGRAM LINK:</label>
                    <input type="url" name="instagram" placeholder="http://" value="{{ $data->instagram }}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>YOUTUBE LINK:</label>
                    <input type="url" name="youtube" placeholder="http://" value="{{ $data->youtube }}">
                    @error('youtube')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="input-field input-submit">
                    <input class="event_status" type="hidden" name="status" value="">
                    <button class="btn-custom preview_btn" type="button">PREVIEW</button>
                    <button class="btn-custom update_submit_btn" type="button">SUBMIT</button>
                  </div>
                </div>
              <!-- </form> -->
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('GOOGLE_API_KEY')}}&callback=editMap"></script>
@endsection