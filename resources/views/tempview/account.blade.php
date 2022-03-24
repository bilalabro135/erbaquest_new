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
            <div class="profile_info">
              <figure>
                @if($users->profile_image)
                  <img src="{{ $users->profile_image }}">
                @else
                  <img src="{{asset('images/avatar.png')}}">
                @endif
              </figure>
              <div class="dt">
                <!-- <h3>LOREM IPSUM</h3> -->
                <h3>{{ $users->name }}</h3>
                <p>{{ $users->user_name }}</p>
              </div>
              <!-- <a href="javascript:;" class="edit_btn"><span class="figure"><img src="{{asset('images/edit-icon.png')}}"></span></a> -->
            </div>
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
              <form class="account_form_val" method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
                 @csrf
                 <input type="hidden" name="username" value="{{ $users->user_name }}">
                 <input type="hidden" name="id" value="{{ $users->id }}">
                <div class="input-field">
                  <label class="">NAME:</label>
                  <input type="text" name="name" placeholder="NAME:" required="required" value="{{ $users->name }}">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>EMAIL:</label>
                  <input type="email" name="email" placeholder="EMAIL:" required="required" value="{{ $users->email }}">
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>PHONE:</label>
                  <input type="tel" name="phone" placeholder="PHONE:" required="required" value="{{ $users->phone }}">
                  @error('phone')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field input-file drop-zone">
                  <label>UPLOAD PICTURE: <span class="figure"><img src="{{asset('images/ft_profile.png')}}"></span><div class="preview"><img id="preview_img" src=""></div></label>
                <button type="button" class="upload_img_btn" id="uploadImg">
                  <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                  <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                </button>
                <input type="file" id="myFile" name="profile_image" class="upload_file drop-zone__input">
                @error('filename')
                    <div class="text-danger">
                        {{$message}}                                            
                    </div>
                @endif
                </div>
                <div class="input-field">
                  <label>ADDRESS:</label>
                  <input type="text" name="address" placeholder="ADDRESS:" value="{{ $users->address }}">
                  @error('address')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>DESCRIPTION:</label>
                  <textarea name="description" placeholder="DESCRIPTION.."></textarea>
                  @error('description')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>PASSWORD:</label>
                  <input id="password" type="password" name="password" placeholder="******" >
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="input-field">
                  <label>Confirm PASSWORD:</label>
                  <input type="password" name="password1" placeholder="******" >
                  @error('password1')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <!-- <div class="input-field input-checkbox">
                  <label class="checkmark">
                      <input type="checkbox" name="agreement" value="1"><a target="_blank" href="terms-and-condition"> I Agree With Terms & Conditon</a>
                  </label>
                  @error('agreement')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div> -->
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
<script type="text/javascript">
	     
      $(document).ready(function() {
       $('.input-field .checkmark input').on('change',function () {
        if($(this).is(':checked'))
            {
              $(this).parent('label').addClass('active');
            }else
            {
             $(this).parent('label').removeClass('active');
            }
           
       });
      });

        $('ul.menu_list li .down-icon').on('click',function(){
          $(this).parent('li').toggleClass('current');
          $(this).parent('li').find('ul.sub-menu').slideToggle();
        })

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