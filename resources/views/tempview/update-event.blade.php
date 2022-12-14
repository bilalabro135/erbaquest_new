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
                    <label>NAME OF QUEST: <span class="figure"><img src="{{asset('images/NAME-OF-QUEST.png')}}"></span></label>
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
                    <button type="button" class="upload_img_btn" id="uploadImg">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    <input type="file" id="myFile" name="featured_image" class="upload_file drop-zone__input" value="{{ $data['featured_image'] }}">
                    @error('featured_image')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 input-field">
                    <label>DESCRIPTION: <span class="figure"><img src="{{asset('images/DESCRIPTION_Icon.png')}}"></span></label>
                    {!! Form::textarea('description', ($data['description']) , array('placeholder' => 'DESCRIPTION..','rows'=>5, 'class' => 'form-control')) !!}

                    @error('description')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>

                    <div class="col-sm-12 col-md-12 AmentieList is_recurring">
                        <div class="input-field input-checkbox checkRight @if($data['is_recurring']) checked @endif">
                            <label>
                                Is Recurring?
                                <input @if($data['is_recurring']) checked="checked" @endif id="is_recurring" type="checkbox" name="is_recurring" value="1">
                            </label>
                        </div>
                    </div>


                  <div class="col-sm-12 col-md-6 input-field input-date">
                    <label>DATE: <span class="figure"><img src="{{asset('images/icons/icon12.png')}}"></span></label>
                    <input type="date" name="event_date" required="required" value="{{ $data['event_date'] }}" @if($data['is_recurring']) disabled="disabled" @endif>
                    @error('event_date')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>

                  <div class="col-sm-12 col-md-6 input-field input-time">
                    <label>Time: <span class="figure"><img src="{{asset('images/icons/icon12.png')}}"></span></label>
                    <input type="time" name="event_time" value="{{ $data['event_time'] }}">
                    @error('event_date')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>

                  <div class="col-sm-12 col-md-6 input-field customDropdown recurring_component">
                        <label>Days Dropdown: <span class="figure"><img src=""></span></label>
                        <select name="day" id="day" required="" class="form-control">
                            <option value="monday" @if( $data["day_dropdown"] == "monday") selected="selected"  @endif>Monday</option>
                            <option value="tuesday" @if( $data["day_dropdown"] == "tuesday") selected="selected"  @endif>Tuesday</option>
                            <option value="wednesday" @if( $data["day_dropdown"] == "wednesday") selected="selected"  @endif>Wednesday</option>
                            <option value="thursday" @if( $data["day_dropdown"] == "thursday") selected="selected"  @endif>Thursday</option>
                            <option value="friday" @if( $data["day_dropdown"] == "friday") selected="selected"  @endif>Friday</option>
                            <option value="saturday" @if( $data["day_dropdown"] == "saturday") selected="selected"  @endif>Saturday</option>
                            <option value="sunday" @if( $data["day_dropdown"] == "sunday") selected="selected"  @endif>Sunday</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-6 input-field customDropdown recurring_component">
                        <label>Recurring Type: <span class="figure"><img src=""></span></label>
                        <select name="recurring_type" id="recurring_type" required="" class="form-control">
                            <option value="weekly" @if( $data["recurring_type"] == "weekly") selected="selected"  @endif>Weekly</option>
                            <option value="monthly" @if( $data["recurring_type"] == "monthly") selected="selected"  @endif>Monthly</option>
                            <option value="yearly" @if( $data["recurring_type"] == "yearly") selected="selected"  @endif>Yearly</option>
                        </select>
                    </div>

                  <div class="col-sm-12 col-md-12 input-field input-file drop-zonemul">
                    <label>GALLERY PICTURES:
                      <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span>
                      <div class="preview1">
                       @if($data['gallery'])
                          @foreach($data['gallery'] as $galleries)
                              <img id="preview_img" src="{{asset($galleries['url'])}}">
                          @endforeach
                        @endif
                      </div>
                    </label>
                    <button type="button" class="upload_img_btn" id="uploadImg1">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    <input type="file" id="myFile1" name="gallery[]" class="upload_file upload_file_multi" value="" multiple>
                    @error('gallery')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>



                  <div class="col-sm-12 col-md-6">
                    <div class="input-field input-locate">
                        <label for="pac-input">Address: <span class="figure"><img src="{{asset('images/icons/icon13.png')}}"></span></label>
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
                    <label>TYPE OF EVENT: <span class="figure"><img src="{{asset('images/icons/icon14.png')}}"></span></label>



                    <select class="js-example-basic-multiple" name="type[]" multiple="multiple">
                      @if($tyoesOfEvents)
                          @foreach($tyoesOfEvents as $tyoesOfEvent)
                              @if($data['type'] != null)
                                @if(in_array($tyoesOfEvent['name'], $data['type']) === TRUE)
                                    <option value="{{$tyoesOfEvent['name']}}" selected="selected">{{$tyoesOfEvent['name']}}</option>
                                @else
                                    <option value="{{$tyoesOfEvent['name']}}">{{$tyoesOfEvent['name']}}</option>
                                @endif
                              @else
                                <option value="{{$tyoesOfEvent['name']}}">{{$tyoesOfEvent['name']}}</option>
                              @endif
                          @endforeach
                          @error('tyoesOfEvent')
                          <div class="text-danger">
                              {{$message}}
                          </div>
                          @endif
                      @endif
                    </select>

                    @error('type')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                    <div class="donation">
                      <div class="input-field input-full">
                        <label>EXPECTED DOOR DONATION: <span class="figure"><img src="{{asset('images/icons/icon15.png')}}"></span></label>
                        <input type="text" name="door_dontation" placeholder="$10.0" value="{{ $data['door_dontation'] }}">
                        @error('door_dontation')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP DONATION: <span class="figure"><img src="{{asset('images/icons/icon16.png')}}"></span></label>
                        <input type="text" name="vip_dontation" placeholder="$500.0" value="{{ $data['vip_dontation'] }}">
                        @error('vip_dontation')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>VIP PERKS: <span class="figure"><img src="{{asset('images/icons/icon17.png')}}"></span></label>
                        <input type="text" name="vip_perk" placeholder="$50.0" value="{{ $data['vip_perk'] }}">
                        @error('vip_perk')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>CHARITY: <span class="figure"><img src="{{asset('images/icons/icon16.png')}}"></span></label>
                        <input type="text" name="charity" placeholder="$10.0" value="{{ $data['charity'] }}">
                        @error('charity')
                            <div class="text-danger">
                                {{$message}}
                            </div>
                        @endif
                      </div>
                      <div class="input-field input-half">
                        <label>COST TO VEND: <span class="figure"><img src="{{asset('images/icons/icon17.png')}}"></span></label>
                        <input type="text" name="cost_of_vendor" placeholder="$30.0" value="{{ $data['cost_of_vendor'] }}">
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
                      @foreach($vendorProfiles as $vendor)
                        <option value="{{$vendor['id']}}" @if($vendor['selected']) selected="selected" @endif >{{$vendor['name']}}</option>
                      @endforeach
                      @error('vendor')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                      @endif
                    </select>
                    <div class="Socialshare">
                      <p>Can???t find vendor? <a href="javascript:;">ASK to join</a></p>
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
                    <input type="number" value="{{ $data['vendor_space_available'] }}" step="1" name="vendor_space_available"  class="input-text qty text" size="4" pattern="" inputmode="" >
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
                          <div class="input-field input-checkbox checkRight @if($amenity['selected']) checked @endif ">
                            <label>
                              <span class="figure"><img src="{{ $amenity['icon'] }}"></span>{{ $amenity['name'] }}
                              <input id="{{ $amenity['name'] }}{{ $amenity['id'] }}" type="checkbox" name="amenities[]" value="{{$amenity['id']}}" @if($amenity['selected']) checked="checked" @endif >
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
                    <select name="area" id="area" class="form-control">
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
                    <label>HEIGHT: <span class="figure"><img src="{{asset('images/icons/icon6.png')}}"></span></label>
                    <input type="text" name="height" value="{{ $data['height'] }}" placeholder="100ft" >
                    @error('height')
                      <div class="text-danger">
                          {{$message}}
                      </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>CAPACITY: <span class="figure"><img src="{{asset('images/icons/icon7.png')}}"></span></label>
                    <input type="number" name="capacity" value="{{ $data['capacity'] }}" placeholder="Capacity">
                    @error('capacity')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field customDropdown">
                    <label>ATM ON SITE: <span class="figure"><img src="{{asset('images/icons/icon8.png')}}"></span></label>
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
                    <label>TICKETING PHONE NUMBER: <span class="figure"><img src="{{asset('images/icons/icon9.png')}}"></span></label>
                    <input class="phone_mask" type="text" name="tickiting_number" placeholder="Ticket Number:" value="{{ $data['tickiting_number'] }}">
                    @error('tickiting_number')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>VENDOR PHONE NUMBER: <span class="figure"><img src="{{asset('images/icons/icon10.png')}}"></span></label>
                    <input class="phone_mask" type="text" name="vendor_number" placeholder="Vendor Number:" value="{{ $data['vendor_number'] }}">
                    @error('vendor_number')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <!-- <div class="col-sm-12 col-md-6 input-field">
                    <label>USER NUMBER: <span class="figure"><img src="{{asset('images/icons/icon10.png')}}"></span></label>
                    <input type="text" name="user_number" placeholder="User Number:" value="{{ $data['user_number'] }}" >
                    @error('user_number')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div> -->
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>WEBSITE LINK: <span class="figure"><img src="{{asset('images/icons/website-link.png')}}"></span></label>
                    <input type="url" name="website_link" placeholder="http://" value="{{ $data['website_link'] }}">
                    @error('website_link')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>FACEBOOK LINK: <span class="figure"><img src="{{asset('images/icons/facebook-link-icon.png')}}"></span></label>
                    <input type="url" name="facebook" placeholder="http://" value="{{ $data['facebook'] }}">
                    @error('facebook')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TWITTER LINK: <span class="figure"><img src="{{asset('images/icons/twitter-link-icon.png')}}"></span></label>
                    <input type="url" name="twitter" placeholder="http://"  value="{{ $data['twitter'] }}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>LINKEDIN LINK: <span class="figure"><img src="{{asset('images/icons/linkind-lick-icon.png')}}"></span></label>
                    <input type="url" name="linkedin" placeholder="http://" value="{{ $data['linkedin'] }}">
                    @error('linkedin')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>INSTAGRAM LINK: <span class="figure"><img src="{{asset('images/icons/instagram-link-icon.png')}}"></span></label>
                    <input type="url" name="instagram" placeholder="http://" value="{{ $data['instagram'] }}">
                    @error('twitter')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>YOUTUBE LINK: <span class="figure"><img src="{{asset('images/icons/youtube-link-icon.png')}}"></span></label>
                    <input type="url" name="youtube" placeholder="http://" value="{{ $data['youtube'] }}">
                    @error('youtube')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TELEGRAM LINK: <span class="figure"><img src="{{asset('images/icons/youtube-link-icon.png')}}"></span></label>
                    <input type="url" name="telegram" placeholder="http://" value="{{ $data['telegram'] }}">
                    @error('telegram')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="col-sm-12 col-md-6 input-field">
                    <label>DISCORD LINK: <span class="figure"><img src="{{asset('images/icons/youtube-link-icon.png')}}"></span></label>
                    <input type="url" name="discord" placeholder="http://" value="{{ $data['discord'] }}">
                    @error('discord')
                        <div class="text-danger">
                            {{$message}}
                        </div>
                    @endif
                  </div>
                  <div class="input-field input-submit my-three-btn">
                    <input class="event_status" type="hidden" name="status" value="">
                    <button class="btn-custom preview_btn" type="button">PREVIEW AND DRAFT</button>
                    <button class="btn-custom update_submit_btn" type="button">SUBMIT</button>
                    <button type="button" class="btn-custom openModal">EDIT TICKET</button>
                  </div>
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </section>

  <style>
      .is_recurring .input-field.input-checkbox label:before{
          position: initial !important;
          margin-right: 11px;
      }
  </style>
  @if(!$data['is_recurring'])
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
                  $(".input-date input").prop( "disabled", true );
              }else{
                  $(".recurring_component").hide();
                  $(".input-date input").prop( "disabled", false );
              }
          });
      });
      $('.openModal').click(function(){
        $('#exampleModal').addClass('showModal');
        $('.modal-dialog').slideDown();
      });
      $('.close').click(function(){
        $('#exampleModal').removeClass('showModal');
      });
  </script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{$globalMapKey->getValue('map_key')}}&callback=editMap"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>


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

      $(".preview1").html('');

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
