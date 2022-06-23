@extends('layouts.front.app')

@section('content')
	@if(isset($pages) && isset($pages->featured_image))
		<x-front.page.featured-image title="{!!$pages->name!!}" image="{{asset($pages->featured_image)}}"/>
	@endif
	    <section class="inner-banner">
      <div class="container">
        <h1 class="ft-blanka">
          ACCOUNT
        </h1>
      </div>
    </section>

    <section class="secAccount pt-100 pb-100">
      <div class="container">
        <div class="row">
          @include( 'tempview/sidebar' )
          <div class="col-sm-12 col-md-8">
            <div class="account_editForm">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              @if(session('msg'))
              <div class="alert alert-{{session('msg_type')}}">
                  {{session('msg')}}                                            
              </div>
              @endif
              <form class="public_profile_val" method="POST" action="{{ route('public.profile.update') }}" enctype="multipart/form-data">
                 @csrf
                <input type="hidden" name="user_id" value="{{ $users['user_id'] }}">
                <div class="row">
                  <div class="col-sm-12 col-md-12 input-field">
                    <label class="">PUBLIC PROFILE NAME:</label>
                    <input type="text" name="public_profile_name" placeholder="NAME:" required="required" value="{{ $users['public_profile_name'] }}">
                    @error('public_profile_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>EMAIL:</label>
                    <input type="email" name="email" placeholder="EMAIL:" required="required" value="{{ $users['email'] }}">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>PHONE:</label>
                    <input class="phone_mask" type="tel" name="phone" placeholder="PHONE:" required="required" value="{{ $users['phone'] }}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="input-field input-file drop-zone">
                    <label>
                      FEATURED PICTURE:
                      <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span>
                      <div class="preview">
                      	@if($users['featured_picture'])
                            <img id="preview_img" src="{{asset($users['featured_picture'])}}">
                        @else
                        	<img id="preview_img" src="">
                        @endif 
                      </div>
                    </label>
                    <button type="button" class="upload_img_btn" id="uploadImg">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    <input type="file" id="myFile" name="featured_picture" class="upload_file drop-zone__input" value="{{ $users['featured_picture'] }}">
                    @error('featured_picture')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>

                  <div class="input-field input-file drop-zone drop-zonemul">
                    <label>
                      PICTURE: 
                      <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span>
                      <div class="preview1">
                      	@if($users['picture'])
                          @foreach($users['picture'] as $galleries)
                              <img id="preview_img" src="{{asset($galleries['url'])}}">
                          @endforeach
                        @endif 
                      </div>
                    </label>
                    <button type="button" class="upload_img_btn" id="uploadImg" data-toggle="tooltip" data-placement="top" title="Multiple images can be added to the gallery, but need to be selected all at once. 
*note- if using a computer you may want to create a folder for the gallery 
you would like to have displayed. ">
                      <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                      <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                    </button>
                    <input type="file" id="myFile" name="picture[]" class="upload_file upload_file_multi"  value="" multiple>
                    @error('picture')
                        <div class="text-danger">
                            {{$message}}                                            
                        </div>
                    @endif
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>WEBSITE:</label>
                    <input type="text" name="website" placeholder="WEBSITE:" value="{{ $users['website'] }}">
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>INSTAGRAM:</label>
                    <input type="text" name="instagram" placeholder="INSTAGRAM:" value="{{ $users['instagram'] }}">
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>FACEBOOK:</label>
                    <input type="text" name="facebook" placeholder="FACEBOOK:" value="{{ $users['facebook'] }}">
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TWITTER:</label>
                    <input type="text" name="twitter" placeholder="TWITTER:" value="{{ $users['twitter'] }}">
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>YOUTUBE:</label>
                    <input type="text" name="youtube" placeholder="YOUTUBE:" value="{{ $users['youtube'] }}">
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>LINKEDIN:</label>
                    <input type="text" name="linkedin" placeholder="LINKEDIN:" value="{{ $users['linkedin'] }}">
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>TELEGRAM:</label>
                    <input type="text" name="telegram" placeholder="TELEGRAM:" value="{{ $users['telegram'] }}">
                  </div>

                  <div class="col-sm-12 col-md-6 input-field">
                    <label>DISCORD:</label>
                    <input type="text" name="discord" placeholder="DISCORD:" value="{{ $users['discord'] }}">
                  </div>

                  <div class="input-field">
                    <label>DESCRIPTION:</label>
                    <textarea name="descreption" placeholder="DESCRIPTION..">{!! $users['descreption'] !!}</textarea>
                  </div>
                </div>
                <div class="input-field input-submit">
                  <input type="submit" name="submit" value="UPDATE">
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>  
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
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

@if( $users['user_id'] )
<script>
	// Public Profile
	$(function() {
	  $(".public_profile_val").validate({
	    rules: {
	      public_profile_name: "required",
	      phone: {
	        required: true,
	        phoneUS: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      featured_picture: {
	        required: false,
	        extension: "png|jpg|jpeg",
	        maxfilesize: 2,
	      },
	      'picture[]': {
	        required: false,
	        extension: "png|jpg|jpeg",
	        maxfilesize: 2,
	      },
        website: {
          required: false,
          url: true
        },
        facebook: {
          required: false,
          url: true
        },
        twitter: {
          required: false,
          url: true
        },
        linkedin: {
          required: false,
          url: true
        },
        instagram: {
          required: false,
          url: true
        },
        youtube: {
          required: false,
          url: true
        },
	    },
	    messages: {
	      name: "The name field is required.",
	      phone: "US Based NUMBER is required.",
	      email: {
	        required:"The email field is required.",
	        email:"Please enter correct email.",
	      },
	      featured_picture: {
	        required:"The FEATURED PICTURE field is required.",
	        extension:"Please use .PNG .JPG .JPEG format",
	        maxfilesize:"File size must be less than 2MB",
	      },
	      'picture[]': {
	        required:"The PICTURE field is required.",
	        extension:"Please use .PNG .JPG .JPEG format",
	        maxfilesize:"File size must be less than 2MB",
	      },
        website_link: {
          url:"Please use the complete link with https:// or http://",
        },
        facebook: {
          url:"Please use the complete link with https:// or http://",
        },
        twitter: {
          url:"Please use the complete link with https:// or http://",
        },
        linkedin: {
          url:"Please use the complete link with https:// or http://",
        },
        instagram: {
          url:"Please use the complete link with https:// or http://",
        },
        youtube: {
          url:"Please use the complete link with https:// or http://",
        },
	    },
	    submitHandler: function(form) {
	      form.submit();
	    }
	  });
	});
</script>
@else
<script>
	// Public Profile
	$(function() {
	  $(".public_profile_val").validate({
	    rules: {
	      public_profile_name: "required",
	      phone: {
	        required: true,
	        phoneUS: true
	      },
	      email: {
	        required: true,
	        email: true
	      },
	      featured_picture: {
	        required: true,
	        extension: "png|jpg|jpeg",
	        maxfilesize: 2,
	      },
	      'picture[]': {
	        required: true,
	        extension: "png|jpg|jpeg",
	        maxfilesize: 2,
	      },
        website: {
          required: false,
          url: true
        },
        facebook: {
          required: false,
          url: true
        },
        twitter: {
          required: false,
          url: true
        },
        linkedin: {
          required: false,
          url: true
        },
        instagram: {
          required: false,
          url: true
        },
        youtube: {
          required: false,
          url: true
        },
	    },
	    messages: {
	      name: "The name field is required.",
	      phone: "US Based NUMBER is required.",
	      email: {
	        required:"The email field is required.",
	        email:"Please enter correct email.",
	      },
	      featured_picture: {
	        required:"The FEATURED PICTURE field is required.",
	        extension:"Please use .PNG .JPG .JPEG format",
	        maxfilesize:"File size must be less than 2MB",
	      },
	      'picture[]': {
	        required:"The PICTURE field is required.",
	        extension:"Please use .PNG .JPG .JPEG format",
	        maxfilesize:"File size must be less than 2MB",
	      },
        website_link: {
          url:"Please use the complete link with https:// or http://",
        },
        facebook: {
          url:"Please use the complete link with https:// or http://",
        },
        twitter: {
          url:"Please use the complete link with https:// or http://",
        },
        linkedin: {
          url:"Please use the complete link with https:// or http://",
        },
        instagram: {
          url:"Please use the complete link with https:// or http://",
        },
        youtube: {
          url:"Please use the complete link with https:// or http://",
        },
	    },
	    submitHandler: function(form) {
	      form.submit();
	    }
	  });
	});
</script>
@endif

<style type="text/css">
  .account_form_val .error{
    color: #ed1c1c !important;
    font-size: 15px;
  }
  .account_form_val #agreement-error::before{
    display: none;
  }
  .account_form_val #agreement-error::after{
    display: none;
  }
  .account_form_val #agreement-error{
    position: absolute;
    bottom: -24px;
    padding-left: 0px;
    margin-bottom: 0px;
    left: 0;
  }
</style>
@endpush