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
              <form class="form_sign" action="" method="post">
                <div class="input-field mt-0">
                  <label>Name:</label>
                  <input type="text" name="name" placeholder="Name:" required="required">
                </div>
                <div class="input-field">
                  <label>Email:</label>
                  <input type="email" name="email" placeholder="Email:" required="required">
                </div>
                <div class="input-field">
                  <label>Phone:</label>
                  <input type="tel" name="phone" placeholder="Phone:" required="required">
                </div>
                <div class="input-field">
                  <label>Address:</label>
                  <input type="text" name="address" placeholder="Address:" required="required">
                </div>
                <div class="input-field">
                  <label>Password:</label>
                  <input type="password" name="password" placeholder="Password:" required="required">
                </div>
                <div class="input-field">
                  <label>Confirm Password:</label>
                  <input type="password" name="password1" placeholder="Confirm Password:" required="required">
                </div>
                <div class="input-field input-submit">
                  <input type="submit" name="submit" value="UPDATE">
                </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
    </section>

@endsection