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
          <div class="col-sm-12 col-md-4">
            <div class="sidebar">
              <h3 class="clr-white text-center">DASHBORD</h3>
              <div class="sidebar-menu">
                <ul class="menu_list">
                  <li class="have_child-items">
                    <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                    <a href="javascript:;">My Profile</a>
                    <ul class="sub-menu">
                      <li class="item">
                        <a href="javascript:;">View Profile</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Edit Profile</a>
                      </li>
                    </ul>
                  </li>
                  <li class="current">
                    <a href="javascript:;">Account Setting</a>
                  </li>
                  <li class="have_child-items">
                    <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                    <a href="javascript:;">My Events</a>
                    <ul class="sub-menu">
                      <li class="item">
                        <a href="javascript:;">Add Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Upcoming Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Edit Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Draft</a>
                      </li>
                    </ul>
                  </li>
                  <li class="have_child-items">
                    <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                    <a href="javascript:;">My Order</a>
                    <ul class="sub-menu">
                      <li class="item">
                        <a href="javascript:;">Add Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Upcoming Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Edit Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Draft</a>
                      </li>
                    </ul>
                  </li>
                  <li class="have_child-items">
                    <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
                    <a href="javascript:;">Paymeny History</a>
                    <ul class="sub-menu">
                      <li class="item">
                        <a href="javascript:;">Add Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Upcoming Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Edit Event</a>
                      </li>
                      <li class="item">
                        <a href="javascript:;">Draft</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <a href="javascript:;">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-8">
            <div class="account_editForm">
              <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="input-field mt-0">
                  <label>NAME:</label>
                  <input type="text" name="name" placeholder="NAME:" required="required" value="LOREM IPSUM">
                </div>
                <div class="input-field">
                  <label>DESCRIPTION:</label>
                  <textarea name="description" placeholder="DESCRIPTION.."></textarea>
                </div>
                <div class="input-field input-file">
                  <label>UPLOAD PICTURE: </label>
                  <input type="file" id="myFile" name="filename">
                  <div class="preview"></div>
                  <button type="button" id="uploadImg">
                    <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                    <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                  </button>
                </div>
                <div class="input-field">
                  <label>PHONE:</label>
                  <input type="tel" name="phone" placeholder="PHONE:" value="+(123)4567890">
                </div>
                <div class="input-field">
                  <label>EMAIL:</label>
                  <input type="email" name="email" placeholder="EMAIL:" required="required" value="erbaquest@gmail.com">
                </div>
                <div class="input-field">
                  <label>Website: <span class="icon clr-green"><i class="fas fa-globe"></i></span></label>
                  <input type="url" name="website" placeholder="https://" required="required">
                </div>
                <div class="input-field">
                  <label>Facebook Link: <span class="icon clr-green"><i class="fab fa-facebook-f"></i></span></label>
                  <input type="url" name="facebook_link" placeholder="https://" required="required">
                </div>
                <div class="input-field">
                  <label>Twitter Link: <span class="icon clr-green"><i class="fab fa-twitter"></i></span></label>
                  <input type="url" name="twitter_link" placeholder="https://" required="required">
                </div>
                <div class="input-field">
                  <label>LinkedIn Link: <span class="icon clr-green"><i class="fab fa-linkedin-in"></i></span></label>
                  <input type="url" name="linkedin_link" placeholder="https://" required="required">
                </div>
                <div class="input-field">
                  <label>Instagram Link: <span class="icon clr-green"><i class="fab fa-instagram"></i></span></label>
                  <input type="url" name="instagram_link" placeholder="https://" required="required">
                </div>
                <div class="input-field">
                  <label>Youtube Link: <span class="icon clr-green"><i class="fab fa-youtube"></i></span></label>
                  <input type="url" name="youtube_link" placeholder="https://" required="required">
                </div>
                <div class="input-field input-file">
                  <label>FEATURED PICTURES: </label>
                  <input type="file" id="myFile" name="filename">
                  <div class="preview"></div>
                  <button type="button" id="uploadImg">
                    <span class="figure"><img src="{{asset('images/uploadIcon.png')}}"></span>
                    <span class="txt">Click Here to Upload File or <span class="clr-green">Browse</span></span>
                  </button>
                </div>
                <div class="input-field input-submit">
                  <input type="submit" name="submit" value="UPDATE">
                  <button class="btn-custom" type="button">PREVIEW</button>
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
	
        $('ul.menu_list li .down-icon').on('click',function(){
          $(this).parent('li').toggleClass('current');
          $(this).parent('li').find('ul.sub-menu').slideToggle();
        })
</script>

@endpush