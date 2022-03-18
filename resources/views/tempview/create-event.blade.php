@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          CREATE EVENT
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
              <form class="front_event_create" action="{{route('front.events.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>NAME OF QUEST:</label>
                    <input type="text" name="name" placeholder="NAME:" required="required" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file featured_image_main drop-zone">
                    <label>FEATURED PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span><div class="preview"><img id="preview_img" src=""></div></label>
                    <input type="file" id="myFile" name="featured_image" class="upload_file drop-zone__input" required="required">
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
                   <!--  <textarea name="description" placeholder="DESCRIPTION.."></textarea> -->
                   {!! Form::textarea('description', null, array('placeholder' => 'DESCRIPTION..','rows'=>5, 'class' => 'form-control')) !!}
                    @error('description')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file drop-zonemul">
                    <label>PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span><div class="preview1"></div></label>
                    <input type="file" id="myFile1" name="gallery[]" class="upload_file upload_file_multi" multiple required="required">
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
                    <input type="date" name="event_date" required="required">
                    @error('event_date')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="input-field input-locate">
                        <label for="pac-input">Address:</label>
                        <input id="pac-input" class="form-control mb-3 " name="address" type="text" placeholder="Enter a location" required="required"/>
                        <div id="googlemap" style="height: 300px"></div>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div id="infowindow-content">
                          <span id="place-name" class="title"></span><br />
                          <span id="place-address"></span>
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
                    <select name="type" required="required">
                        <option selected="selected">Type:</option>
                        @foreach($tyoesOfEvents as $tyoesOfEvent)
                        <option value="{{$tyoesOfEvent['name']}}">{{$tyoesOfEvent['name']}}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                    <div class="donation">
                      <div class="input-field input-full">
                        <label>EXPECTED DOOR DONATION:</label>
                        <input type="text" name="door_dontation" placeholder="$10.0" required="required" value="{{ old('door_dontation') }}">
                        @error('door_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP DONATION:</label>
                        <input type="text" name="vip_dontation" placeholder="$500.0" required="required" value="{{ old('vip_dontation') }}">
                        @error('vip_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP PERKS:</label>
                        <input type="text" name="vip_perk" placeholder="$50.0" required="required" value="{{ old('vip_perk') }}">
                        @error('vip_perk')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>CHARITY:</label>
                        <input type="text" name="charity" placeholder="$10.0" required="required" value="{{ old('charity') }}">
                        @error('charity')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>COST TO VEND:</label>
                        <input type="text" name="cost_of_vendor" placeholder="$30.0" required="required" value="{{ old('cost_of_vendor') }}">
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
                    <input type="text" class="vendor_list" name="vendor_list" required="required" placeholder="VENDOR:" value="{{ old('vendor_list') }}">
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
                    </ul>
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR SPACES AVAILABLE:</label>
                    <input type="number" name="vendor_space_available" value="1" value="{{ old('vendor_space_available') }}" required="required">
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
                              <input id="{{ $amenity->name }}{{ $amenity->id }}" type="checkbox" name="amenities[]" value="{{$amenity->id}}">
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
                    <input type="text" name="height" value="{{ old('height') }}" placeholder="100ft" required="required">
                    @error('height')
                      <div class="text-danger">
                          {{$message}}                                            
                      </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>CAPACITY:</label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" placeholder="Capacity" required="required">
                    @error('capacity')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>ATM ON SITE:</label>
                    <select name="ATM_on_site" required="required">
                      <option selected="selected">ATM ON SITE:</option>
                      <option>Yes</option>
                      <option>No</option>
                    </select>
                    @error('ATM_on_site')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TICKETING NUMBER:</label>
                    <input type="text" name="tickiting_number" placeholder="Ticket Number:" value="{{ old('tickiting_number') }}" required="required">
                    @error('tickiting_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR NUMBER:</label>
                    <input type="text" name="vendor_number" placeholder="Vendor Number:" value="{{old('vendor_number')}}" value="{{ old('vendor_number') }}" required="required">
                    @error('vendor_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>USER NUMBER:</label>
                    <input type="text" name="user_number" placeholder="User Number:" value="{{old('user_number')}}" required="required">
                    @error('user_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>WEBSITE LINK:</label>
                    <input type="url" name="website_link" placeholder="http://" value="{{old('website_link')}}" required="required">
                    @error('website_link')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>FACEBOOK LINK:</label>
                    <input type="url" name="facebook" placeholder="http://" value="{{old('facebook')}}" required="required">
                    @error('facebook')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TWITTER LINK:</label>
                    <input type="url" name="twitter" placeholder="http://"  value="{{old('twitter')}}" required="required">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>LINKEDIN LINK:</label>
                    <input type="url" name="linkedin" placeholder="http://" value="{{old('linkedin')}}" required="required">
                    @error('linkedin')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>INSTAGRAM LINK:</label>
                    <input type="url" name="instagram" placeholder="http://" value="{{old('instagram')}}" required="required">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>YOUTUBE LINK:</label>
                    <input type="url" name="youtube" placeholder="http://" value="{{old('youtube')}}" required="required">
                    @error('youtube')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="input-field input-submit">
                    <input class="event_status" type="hidden" name="status" value="">
                    <button class="btn-custom preview_btn" type="button">PREVIEW</button>
                    <button class="btn-custom submit_btn" type="button">SUBMIT</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('GOOGLE_API_KEY')}}&callback=initMap"></script>

<script>
    document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
      const dropZoneElement = inputElement.closest(".drop-zone");

      dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
      });

      inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
          updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
      });

      dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
      });

      ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
          dropZoneElement.classList.remove("drop-zone--over");
        });
      });

      dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
          inputElement.files = e.dataTransfer.files;
          updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
        }

        dropZoneElement.classList.remove("drop-zone--over");
      });
    });

    /**
     * Updates the thumbnail on a drop zone element.
     *
     * @param {HTMLElement} dropZoneElement
     * @param {File} file
     */
    function updateThumbnail(dropZoneElement, file) {

      // First time - remove the prompt
      if (dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
      }

      // Show thumbnail for image files
      if (file.type.startsWith("image/")) {
        const reader = new FileReader();

        reader.readAsDataURL(file);
        reader.onload = () => {
          $("#preview_img").attr("src",`${reader.result}`);
        };
      } else {
        $("#preview_img").attr("src","");
      }
    }

  </script>

  <script>
    document.querySelectorAll(".upload_file_multi").forEach((inputElement) => {
      const dropZoneElement = inputElement.closest(".drop-zonemul");

      dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
      });

      inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
          updateThumbnailMulti(dropZoneElement, inputElement.files);
        }
      });

      dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
      });

      ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
          dropZoneElement.classList.remove("drop-zone--over");
        });
      });

      dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();

        if (e.dataTransfer.files.length) {
          inputElement.files = e.dataTransfer.files;
          updateThumbnailMulti(dropZoneElement, e.dataTransfer.files);
        }

        dropZoneElement.classList.remove("drop-zone--over");
      });
    });

    function updateThumbnailMulti(dropZoneElement, file) {

     
      

      if (dropZoneElement.querySelector(".drop-zone__prompt")) {
        dropZoneElement.querySelector(".drop-zone__prompt").remove();
      }

      var i;
      for (i = 0; i < file.length; ++i) {

      
        if (file[i].type.startsWith("image/")) {
          const reader = new FileReader();

          reader.readAsDataURL(file[i]);
          reader.onload = () => {
            console.log(`${reader.result}`);
            $(".preview1").append("<img src='"+`${reader.result}`+"' />");
          };
        } else {
          $(".preview1").html();
        }
      }


    }

  </script>
@endsection
