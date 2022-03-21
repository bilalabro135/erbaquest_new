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
                    
                    <button type="button" class="upload_img_btn" id="uploadImg">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    <input type="file" id="myFile" name="featured_image" class="upload_file drop-zone__input" required="required">
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
                    <button type="button" class="upload_img_btn" id="uploadImg1">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    <input type="file" id="myFile1" name="gallery[]" class="upload_file upload_file_multi" multiple required="required">
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
                        <input type="number" name="door_dontation" placeholder="$10.0" required="required" value="{{ old('door_dontation') }}">
                        @error('door_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP DONATION:</label>
                        <input type="number" name="vip_dontation" placeholder="$500.0" required="required" value="{{ old('vip_dontation') }}">
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
                        <input type="number" name="cost_of_vendor" placeholder="$30.0" required="required" value="{{ old('cost_of_vendor') }}">
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
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                      @endforeach
                      @error('vendor')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                      @endif
                    </select>
                    <div class="Socialshare">
                      <p>Can’t find vendor? <a href="javascript:;">ASK to join</a></p>
                      <ul>
                        <li>
                          <a href="javascript:void(0)" onclick="javascript:facebookSocialShare('http://www.facebook.com/sharer.php?u=https%3A%2F%2Ferba-quest.geeksroot.net%2F')"><i class="fab fa-facebook-square"></i>Facebook</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)" onclick="javascript:twitterSocialShare('http://twitter.com/share?text=ErbaLogin&url=https%3A%2F%2Ferba-quest.geeksroot.net%2F')"><i class="fab fa-twitter-square"></i>Twitter</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)" onclick="javascript:whatsAppSocialShare('https://api.whatsapp.com/send/?text=https%3A%2F%2Ferba-quest.geeksroot.net%2F&app_absent=0')"><i class="fab fa-whatsapp-square"></i>WhatsApp</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)" onclick="javascript:emailSocialShare('mailto:areeb.ghouri@geeksroot.com?subject=ErbaLogin&body=Check out this site https%3A%2F%2Ferba-quest.geeksroot.net%2F')"><i class="fas fa-envelope"></i>Email</a>
                        </li>
                        
                        <li class="example">
                          <a href="javascript:void(0)" class="btn" data-clipboard-demo data-clipboard-action="copy" data-clipboard-text="https://erba-quest.geeksroot.net/login"><i class="fas fa-copy"></i> Copy Link</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <!-- <div class="col-sm-12 col-md-6 input-field inputTags">
                    <ul class="vendorTags">
                    </ul>
                  </div> -->
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
                            <option value="{{$country->name}}">{{$country->name}}</option>
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
                    <input type="number" name="tickiting_number" placeholder="Ticket Number:" value="{{ old('tickiting_number') }}" required="required">
                    @error('tickiting_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR NUMBER:</label>
                    <input type="number" name="vendor_number" placeholder="Vendor Number:" value="{{old('vendor_number')}}" value="{{ old('vendor_number') }}" required="required">
                    @error('vendor_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>USER NUMBER:</label>
                    <input type="number" name="user_number" placeholder="User Number:" value="{{old('user_number')}}" required="required">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
  
<script>
  $(".Socialshare p a").click(function(){
    $(".Socialshare ul").slideToggle();
  });
  // demos.js
  var clipboardDemos = new Clipboard('[data-clipboard-demo]');
  clipboardDemos.on('success', function(e) {
      e.clearSelection();
      console.info('Action:', e.action);
      console.info('Text:', e.text);
      console.info('Trigger:', e.trigger);
      showTooltip(e.trigger, 'Copied!');
  });

  clipboardDemos.on('error', function(e) {
      console.error('Action:', e.action);
      console.error('Trigger:', e.trigger);
      showTooltip(e.trigger, fallbackMessage(e.action));
  });
  // tooltips.js
  var btns = document.querySelectorAll('.btn');
  for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener('mouseleave', clearTooltip);
      btns[i].addEventListener('blur', clearTooltip);
  }
  function clearTooltip(e) {
      e.currentTarget.setAttribute('class', 'btn');
      e.currentTarget.removeAttribute('aria-label');
  }
  function showTooltip(elem, msg) {
      elem.setAttribute('class', 'btn tooltipped tooltipped-s');
      elem.setAttribute('aria-label', msg);
  }
  // Facebook Share
  function facebookSocialShare(url){
      window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
      return true;
  }
  // Twitter Share
  function twitterSocialShare(url){
      window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
      return true;
  }
  // Insta Share
  function instaSocialShare(url){
      window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
      return true;
  }
  // Email Share
  function emailSocialShare(url){
      window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
      return true;
  }
  // whatsApp Share
  function whatsAppSocialShare(url){
      window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
      return true;
  }
</script>
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
    $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
    });

  </script>
  <script src="https://kit.fontawesome.com/d97b87339f.js" crossorigin="anonymous"></script>
@endsection
