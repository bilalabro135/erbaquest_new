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

    <section class="event-inner createEvent pt-100 pb-100">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="createEventForm margin-tb">
              <form class="front_event_update" action="{{ route('front.events.frontupdate', $data['id']) }}" method="post" enctype="multipart/form-data">
              <!-- <form class="front_event_create" action="{{route('front.events.store')}}" method="POST" enctype="multipart/form-data"> -->
                <?php //echo"<pre>";print_r($data); ?>
                @csrf
                <input type="hidden" name="checkevent" value="update">
                <div class="row">
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>NAME OF QUEST:</label>
                    <input type="text" name="name" placeholder="NAME:" required="required" value="{{ $data['name'] }}">
                    @error('name')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file drop-zone">
                    <label>FEATURED PICTURE: 
                      <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span>
                      <div class="preview">
                        @if($data['featured_image'])
                        <img id="preview_img" src="{{asset($data['featured_image'])}}">
                        @else
                        <img id="preview_img" src="">
                        @endif
                      </div>
                    </label>
                    <input type="file" id="myFile" name="featured_image" class="upload_file drop-zone__input" value="{{ $data['featured_image'] }}">
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
                    <label>DESCRIPTION: {{ $data['description'] }}</label>
                    {!! Form::textarea('description', ($data['description']) , array('placeholder' => 'DESCRIPTION..','rows'=>5, 'class' => 'form-control')) !!}

                    @error('description')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file drop-zonemul">
                    <label>PICTURE: 
                      <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span>
                      <div class="preview1">
                       @if($data['gallery'])
                          @foreach($data['gallery'] as $galleries)
                              <img id="preview_img" src="{{asset($galleries['url'])}}">
                          @endforeach
                        @endif 
                      </div>
                    </label>
                    <input type="file" id="myFile1" name="gallery[]" class="upload_file upload_file_multi" value="" multiple>
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
                    <input type="date" name="event_date" value="{{ $data['event_date'] }}">
                    @error('event_date')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="input-field input-locate">
                        <label for="pac-input">Address:</label>
                        <input id="edit_pac-input" class="form-control mb-3 " name="address" type="text" placeholder="Enter a location" required="required" value="{{ $data['address'] }}" />
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

                    <select name="type" required="required">
                        <option selected="selected">Type: </option>
                        @foreach($tyoesOfEvents as $tyoesOfEvent) 
                          <option value="{{$tyoesOfEvent['name']}}" @if($tyoesOfEvent['name'] == $data['type'] ) selected="selected" @endif>{{$tyoesOfEvent['name']}}</option>
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
                        <input type="text" name="door_dontation" placeholder="$10.0" required="required" value="{{ $data['door_dontation'] }}">
                        @error('door_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP DONATION:</label>
                        <input type="text" name="vip_dontation" placeholder="$500.0" required="required" value="{{ $data['vip_dontation'] }}">
                        @error('vip_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP PERKS:</label>
                        <input type="text" name="vip_perk" placeholder="$50.0" required="required" value="{{ $data['vip_perk'] }}">
                        @error('vip_perk')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>CHARITY:</label>
                        <input type="text" name="charity" placeholder="$10.0" required="required" value="{{ $data['charity'] }}">
                        @error('charity')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>COST TO VEND:</label>
                        <input type="text" name="cost_of_vendor" placeholder="$30.0" required="required" value="{{ $data['cost_of_vendor'] }}">
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
                    <select class="js-example-basic-multiple" id="vendor_select" name="vendor_list[]" multiple="multiple" required="required">
                      @foreach($vendors as $vendor)
                        <option value="{{$vendor['id']}}" @if($vendor['selected']) selected="selected" @endif >{{$vendor['name']}}</option>
                      @endforeach
                      @error('vendor')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                      @endif
                    </select>
                  </div>
                  <!-- <div class="col-sm-12 col-md-6 input-field inputTags">
                    <ul class="vendorTags">
                    </ul>
                  </div> -->
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR SPACES AVAILABLE:</label>
                    <input type="number" name="vendor_space_available" value="1" value="{{ $data['vendor_space_available'] }}">
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
                              <span class="figure"><img src="{{ $amenity['icon'] }}"></span>{{ $amenity['name'] }}
                              <input id="{{ $amenity['name'] }}{{ $amenity['id'] }}" type="checkbox" name="amenities[]" value="{{$amenity['id']}}" required="required">
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
                        <option value="">Select Location</option>
                        @foreach($countries as $country)
                            <option value="{{$country->name}}" @if($country->name == $data['area'] ) selected="selected" @endif>{{$country->name}}</option>
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
                    <input type="text" name="height" value="{{ $data['height'] }}" placeholder="100ft" required="required">
                    @error('height')
                      <div class="text-danger">
                          {{$message}}                                            
                      </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>CAPACITY:</label>
                    <input type="number" name="capacity" value="{{ $data['capacity'] }}" placeholder="Capacity">
                    @error('capacity')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>ATM ON SITE:</label>
                    <select name="ATM_on_site" id="ATM_on_site" required="" class="form-control">
                        <option value="Yes" selected {{(isset($event['ATM_on_site']) && $event['ATM_on_site'] == "Yes") ? 'selected="selected"' : ''}}>Yes</option>
                        <option value="No" {{(isset($event['ATM_on_site']) && $event['ATM_on_site'] == "No") ? 'selected="selected"' : ''}}>No</option>
                    </select> 
                    @error('ATM_on_site')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TICKETING NUMBER:</label>
                    <input type="text" name="tickiting_number" placeholder="Ticket Number:" value="{{ $data['tickiting_number'] }}">
                    @error('tickiting_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR NUMBER:</label>
                    <input type="text" name="vendor_number" placeholder="Vendor Number:" value="{{ $data['vendor_number'] }}">
                    @error('vendor_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>USER NUMBER:</label>
                    <input type="text" name="user_number" placeholder="User Number:" value="{{ $data['user_number'] }}" >
                    @error('user_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>WEBSITE LINK:</label>
                    <input type="url" name="website_link" placeholder="http://" value="{{ $data['website_link'] }}">
                    @error('website_link')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>FACEBOOK LINK:</label>
                    <input type="url" name="facebook" placeholder="http://" value="{{ $data['facebook'] }}">
                    @error('facebook')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TWITTER LINK:</label>
                    <input type="url" name="twitter" placeholder="http://"  value="{{ $data['twitter'] }}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>LINKEDIN LINK:</label>
                    <input type="url" name="linkedin" placeholder="http://" value="{{ $data['linkedin'] }}">
                    @error('linkedin')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>INSTAGRAM LINK:</label>
                    <input type="url" name="instagram" placeholder="http://" value="{{ $data['instagram'] }}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>YOUTUBE LINK:</label>
                    <input type="url" name="youtube" placeholder="http://" value="{{ $data['youtube'] }}">
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
        //$(".preview1").html("");
          //$("#myFile1").val("");
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
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });
  </script>
@endsection