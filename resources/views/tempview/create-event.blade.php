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
                    <label>NAME OF QUEST: <span class="figure"><img src="{{asset('images/NAME-OF-QUEST.png')}}"></span></label>
                    <input type="text" name="name" placeholder="NAME:" required="required" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field input-file featured_image_main drop-zone">
                    <label>FEATURED PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span><div class="preview"><img id="preview_img" src=""></div></label>
                    
                    <button type="button" class="upload_img_btn" id="uploadImg" onchange="Filevalidation()">
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
                    <label>DESCRIPTION: <span class="figure"><img src="{{asset('images/DESCRIPTION_Icon.png')}}"></span></label>
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
                    <label>DATE: <span class="figure"><img src="{{asset('images/icons/icon12.png')}}"></span></label>
                    <input type="date" name="event_date" required="required" value="{{ old('event_date') }}">
                    @error('event_date')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <div class="input-field input-locate">
                        <label for="pac-input">Address: <span class="figure"><img src="{{asset('images/icons/icon13.png')}}"></span></label>
                        <input id="pac-input" class="form-control mb-3 " name="address" type="text" placeholder="Enter a location" required="required" value="{{ old('address') }}" />
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
                    <label>TYPE OF EVENT: <span class="figure"><img src="{{asset('images/icons/icon14.png')}}"></span></label>
                    <select name="type" required="required" value="{{ old('type') }}">
                        <option value="">Type:</option>
                        @foreach($tyoesOfEvents as $tyoesOfEvent)
                        <option value="{{$tyoesOfEvent['name']}}" @if($tyoesOfEvent['name'] == old('type') ) selected="selected" @endif>{{$tyoesOfEvent['name']}}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                    <div class="donation">
                      <div class="input-field input-full">
                        <label>EXPECTED DOOR DONATION: <span class="figure"><img src="{{asset('images/icons/icon15.png')}}"></span></label>
                        <input type="number" name="door_dontation" placeholder="$10.0" required="required" value="{{ old('door_dontation') }}">
                        @error('door_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP DONATION: <span class="figure"><img src="{{asset('images/icons/icon16.png')}}"></span></label>
                        <input type="number" name="vip_dontation" placeholder="$500.0" required="required" value="{{ old('vip_dontation') }}">
                        @error('vip_dontation')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP PERKS: <span class="figure"><img src="{{asset('images/icons/icon17.png')}}"></span></label>
                        <input type="text" name="vip_perk" placeholder="50.0" required="required" value="{{ old('vip_perk') }}">
                        @error('vip_perk')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>CHARITY: <span class="figure"><img src="{{asset('images/icons/icon16.png')}}"></span></label>
                        <input type="text" name="charity" placeholder="10.0" required="required" value="{{ old('charity') }}">
                        @error('charity')
                            <div class="text-danger">
                                {{$message}}                                            
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>COST TO VEND: <span class="figure"><img src="{{asset('images/icons/icon17.png')}}"></span></label>
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
                    <label>VENDOR: <span class="figure"><img src="{{asset('images/icons/icon18.png')}}"></span></label>
                    <select class="js-example-basic-multiple" id="vendor_select" name="vendor_list[]" multiple="multiple">
                      @if($vendorProfiles)
                        @foreach($vendorProfiles as $vendorProfile)
                          <option value="{{$vendorProfile['id']}}">{{$vendorProfile['name']}}</option>
                        @endforeach
                        @error('vendorProfile')
                          <div class="text-danger">
                              {{$message}}                                            
                          </div>
                        @endif
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
                  <div class="col-sm-12 col-md-6 input-field vendor_space_quantity">
                    <label>VENDOR SPACES AVAILABLE:</label>
                    <div class="quantity buttons_added">
	                    <input type="button" value="-" class="minus">
	                    <input type="number" value="1" step="1" name="vendor_space_available" class="input-text qty text" size="4" pattern="" inputmode="" required="required">
	                    <input type="button" value="+" class="plus">
                    </div>
                    @error('vendor_space_available')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                   @if(count($amenities))
                  <div class="col-sm-12 input-field">
                    <label>AMENTIES:</label>
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
                    <label>AREA: <span class="figure"><img src="{{asset('images/icons/icon5.png')}}"></span></label>
                    <select name="area" id="area" required="" class="form-control">
                        <option value="" selected="selected">Select Location</option>
                        @foreach($countries as $country)
                            <option value="{{$country->name}}" @if($country->name == old('area') ) selected="selected" @endif>{{$country->name}}</option>
                        @endforeach
                    </select> 
                    @error('area')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>HEIGHT: <span class="figure"><img src="{{asset('images/icons/icon6.png')}}"></span></label>
                    <input type="text" name="height" value="{{ old('height') }}" placeholder="100ft" required="required">
                    @error('height')
                      <div class="text-danger">
                          {{$message}}                                            
                      </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>CAPACITY: <span class="figure"><img src="{{asset('images/icons/icon7.png')}}"></span></label>
                    <input type="number" name="capacity" value="{{ old('capacity') }}" placeholder="Capacity" required="required">
                    @error('capacity')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>ATM ON SITE: <span class="figure"><img src="{{asset('images/icons/icon8.png')}}"></span></label>
                    <select name="ATM_on_site" required="required">
                      <option value="">ATM ON SITE:</option>
                      <option >Yes</option>
                      <option>No</option>
                    </select>
                    @error('ATM_on_site')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TICKETING PHONE NUMBER: <span class="figure"><img src="{{asset('images/icons/icon9.png')}}"></span></label>
                    <input class="phone_mask" type="text" name="tickiting_number" placeholder="Ticket Number:" value="{{ old('tickiting_number') }}" required="required">
                    @error('tickiting_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR PHONE NUMBER: <span class="figure"><img src="{{asset('images/icons/icon10.png')}}"></span></label>
                    <input class="phone_mask" type="text" name="vendor_number" placeholder="Vendor Number:" value="{{old('vendor_number')}}" value="{{ old('vendor_number') }}" required="required" maxlength="14">
                    @error('vendor_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <!-- <div class="col-sm-12 col-md-6 input-field">
                    <label>USER NUMBER: <span class="figure"><img src="{{asset('images/icons/icon10.png')}}"></span></label>
                    <input type="number" name="user_number" placeholder="User Number:" value="{{old('user_number')}}" required="required">
                    @error('user_number')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div> -->
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>WEBSITE LINK: <span class="figure"><img src="{{asset('images/icons/website-link.png')}}"></span></label>
                    <input type="url" name="website_link" placeholder="http://" value="{{old('website_link')}}">
                    @error('website_link')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>FACEBOOK LINK: <span class="figure"><img src="{{asset('images/icons/facebook-link-icon.png')}}"></span></label>
                    <input type="url" name="facebook" placeholder="http://" value="{{old('facebook')}}">
                    @error('facebook')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TWITTER LINK: <span class="figure"><img src="{{asset('images/icons/twitter-link-icon.png')}}"></span></label>
                    <input type="url" name="twitter" placeholder="http://"  value="{{old('twitter')}}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>LINKEDIN LINK: <span class="figure"><img src="{{asset('images/icons/linkind-lick-icon.png')}}"></span></label>
                    <input type="url" name="linkedin" placeholder="http://" value="{{old('linkedin')}}">
                    @error('linkedin')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>INSTAGRAM LINK: <span class="figure"><img src="{{asset('images/icons/instagram-link-icon.png')}}"></span></label>
                    <input type="url" name="instagram" placeholder="http://" value="{{old('instagram')}}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>YOUTUBE LINK: <span class="figure"><img src="{{asset('images/icons/youtube-link-icon.png')}}"></span></label>
                    <input type="url" name="youtube" placeholder="http://" value="{{old('youtube')}}">
                    @error('youtube')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>
                  <div class="input-field input-submit">
                    <input class="event_status" type="hidden" name="status" value="">
                    <button class="btn-custom preview_btn" type="button">PREVIEW AND DRAFT</button>
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
<!-- <script src="{{asset('js/front/jquery.mask.min.js') }}"></script> -->

<script>  
    $(document).ready(function(){  
        $('.phone_mask').mask('(999)-999-9999'); 
    });  
</script>  
<script>
	function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
	}
	String.prototype.getDecimals || (String.prototype.getDecimals = function() {
	    var a = this,
	        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
	    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
	}), jQuery(document).ready(function() {
	    wcqib_refresh_quantity_increments()
	}), jQuery(document).on("updated_wc_div", function() {
	    wcqib_refresh_quantity_increments()
	}), jQuery(document).on("click", ".plus, .minus", function() {
	    var a = jQuery(this).closest(".quantity").find(".qty"),
	        b = parseFloat(a.val()),
	        c = parseFloat(a.attr("max")),
	        d = parseFloat(a.attr("min")),
	        e = a.attr("step");
	    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
	});
</script>

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
      $(".preview1").html('');

      var i;
      for (i = 0; i < file.length; ++i) {

      
        if (file[i].type.startsWith("image/")) {
          const reader = new FileReader();

          reader.readAsDataURL(file[i]);
          reader.onload = () => {
            // console.log(`${reader.result}`);
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
