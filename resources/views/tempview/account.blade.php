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
            <div class="profile_info">
              <figure>
                <img src="{{asset('images/profilePic.png')}}">
              </figure>
              <div class="dt">
                <h3>LOREM IPSUM</h3>
                <p>Lorem Ipsum</p>
              </div>
              <a href="javascript:;" class="edit_btn"><span class="figure"><img src="{{asset('images/edit-icon.png')}}"></span></a>
            </div>
            <div class="account_editForm">
              <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="input-field">
                  <label>NAME:</label>
                  <input type="text" name="name" placeholder="NAME:" required="required" value="LOREM IPSUM">
                </div>
                <div class="input-field">
                  <label>EMAIL:</label>
                  <input type="email" name="email" placeholder="EMAIL:" required="required" value="erbaquest@gmail.com">
                </div>
                <div class="input-field">
                  <label>PHONE:</label>
                  <input type="tel" name="phone" placeholder="PHONE:" value="+(123)4567890">
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
                  <label>ADDRESS:</label>
                  <input type="text" name="address" placeholder="ADDRESS:" required="required" value="Keas 69 Str. 15234, Chalandri">
                </div>
                <div class="input-field">
                  <label>DESCRIPTION:</label>
                  <textarea name="description" placeholder="DESCRIPTION.."></textarea>
                </div>
                <div class="input-field">
                  <label>PASSWORD:</label>
                  <input type="text" name="password" placeholder="PASSWORD:" required="required">
                </div>
                <div class="input-field">
                  <label>Confirm PASSWORD:</label>
                  <input type="text" name="password1" placeholder="Confirm PASSWORD:" required="required">
                </div>
                <div class="input-field input-checkbox">
                  <label>
                    <input type="checkbox" name="agreement" required="required">
                    I agree Terms & Conditions
                  </label>
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