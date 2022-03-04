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
          <div class="col-sm-12 col-md-8 UpcomingEvent">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="media-box">
                  <figure>
                    <img src="{{asset('images/media-1.jpg')}}">
                  </figure>
                  <h5 class="cat">THE LIFESTYLE SHOW</h5>
                  <h3>LOREM IPSUM DOLOR</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  <a href="javascript:;" class="md-link">EDIT</a>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="media-box">
                  <figure>
                    <img src="{{asset('images/media-2.jpg')}}">
                  </figure>
                  <h5 class="cat">THE LIFESTYLE SHOW</h5>
                  <h3>LOREM IPSUM DOLOR</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  <a href="javascript:;" class="md-link">EDIT</a>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="media-box">
                  <figure>
                    <img src="{{asset('images/media-3.jpg')}}">
                  </figure>
                  <h5 class="cat">THE LIFESTYLE SHOW</h5>
                  <h3>LOREM IPSUM DOLOR</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  <a href="javascript:;" class="md-link">EDIT</a>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="media-box">
                  <figure>
                    <img src="{{asset('images/media-4.jpg')}}">
                  </figure>
                  <h5 class="cat">THE LIFESTYLE SHOW</h5>
                  <h3>LOREM IPSUM DOLOR</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  <a href="javascript:;" class="md-link">EDIT</a>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="media-box">
                  <figure>
                    <img src="{{asset('images/media-5.jpg')}}">
                  </figure>
                  <h5 class="cat">THE LIFESTYLE SHOW</h5>
                  <h3>LOREM IPSUM DOLOR</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  <a href="javascript:;" class="md-link">EDIT</a>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="media-box">
                  <figure>
                    <img src="{{asset('images/media-6.jpg')}}">
                  </figure>
                  <h5 class="cat">THE LIFESTYLE SHOW</h5>
                  <h3>LOREM IPSUM DOLOR</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                  <a href="javascript:;" class="md-link">EDIT</a>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="pagination">
                  <ul>
                    <li class="pg-nav"><i class="fas fa-chevron-left"></i> PREV</li>
                    <li>1</li>
                    <li class="active">2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li class="pg-nav">NEXT <i class="fas fa-chevron-right"></i></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
    </section>

@endsection