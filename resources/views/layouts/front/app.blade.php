<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Erba Quest</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="manifest" href="manifest.json" />
    <!-- ios support -->

    <meta name="apple-mobile-web-app-status-bar" content="#db4938" />
    <meta name="theme-color" content="#db4938" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/front/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/front/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/front/style.css') }}" />
    <script src="{{ asset('js/front/bootstrap.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('js/front/jquery.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('js/front/owl.carousel.min.js' ) }}" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/bf7b09a514.js" crossorigin="anonymous"></script>
  </head>

  <body>

    <header id="masthead" class="site-header navbar-static-top navbar-light" role="banner">
      <div class="container">

        @if(isset($topbar) && !empty($topbar))
        <div class="topbar">
          <ul class="topbar-list">
            @foreach($topbar as $menu)  
              <li class="" id="{{$menu->attr_id}}">
                <a href="{{get_url($menu->link)}}" class="{{$menu->attr_class}}">{{$menu->title}}</a>
              </li>
            @endforeach
          </ul>
        </div>
        @endif
          <nav class="navbar navbar-expand-xl p-0">
              <div class="navbar-brand">
                <a href="{{route('home')}}"> 
                @if($globalsettings->getValue('site_logo'))
                    <img src="{{ $globalsettings->getValue('site_logo') }}"  alt="{{ ($globalsettings->getValue('site_title')) ? $globalsettings->getValue('site_title') : config('app.name', 'Laravel') }}" >
                  @else
                    {{ ($globalsettings->getValue('site_title')) ? $globalsettings->getValue('site_title') : config('app.name', 'Laravel') }}
                  @endif
                </a>
              </div>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              @if(isset($primarymenu) && !empty($primarymenu))
              <div id="main-nav" class="collapse navbar-collapse justify-content-end">
                <ul id="menu-main-menu" class="navbar-nav">
                  @foreach($primarymenu as $menu)
                  <li class="nav-item {{$menu->attr_class}}" id="{{$menu->attr_id}}">
                    <a href="{{get_url($menu->link)}}" class="nav-link">{{$menu->title}}</a>
                  </li>
                  @endforeach
                </ul>
            </div>
            @endif
          </nav>
      </div>
    </header>
    
    @yield('content')
    <div class="footer_widget">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-3">
            <div class="ft-logo">
              @if($globalsettings->getValue('site_logo'))
              <figure class="ft-logo">
                <img src="{{ $globalsettings->getValue('site_logo') }}"  alt="{{ ($globalsettings->getValue('site_title')) ? $globalsettings->getValue('site_title') : config('app.name', 'Laravel') }}">
              </figure>
              @else
                <h3 class="text-light mb-0">{{ ($globalsettings->getValue('site_title')) ? $globalsettings->getValue('site_title') : config('app.name', 'Laravel') }}</h3>
              @endif
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                 tempor incididunt ut labore et dolore  magna aliqua. </p>
            </div>
          </div>


        @if(isset($quicklinks) && !empty($quicklinks))
          <div class="col-sm-12 col-md-3">
            <h3 class="ft-blanka clr-white">Quick Links</h3>
            <ul class="menu">
              @foreach($quicklinks as $menu)
              <li>
                <a href="{{get_url($menu->link)}}">{{$menu->title}}</a>
              </li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="col-sm-12 col-md-3">
            <h3 class="ft-blanka clr-white">Contact Us</h3>
            <ul class="ct-list">
              @if($globalsettings->getValue('address'))
              <li>
                <i class="fas fa-map-marker-alt"></i>{{$globalsettings->getValue('address')}}
              </li>
              @endif
              @if($globalsettings->getValue('telephone'))
              <li>
                <a href="tel:{{$globalsettings->getValue('telephone')}}">
                <i class="fas fa-phone-volume"></i>{{$globalsettings->getValue('telephone')}}</a>                
              </li>
              @endif
              @if($globalsettings->getValue('email'))
              <li>
                <a href="mailto:{{$globalsettings->getValue('email')}}">
                <i class="far fa-envelope"></i>
                {{$globalsettings->getValue('email')}}</a>
              </li>
              @endif
            </ul>
          </div>
          <div class="col-sm-12 col-md-3">
            <h3 class="ft-blanka clr-white">Social Media</h3>
            @php
              $socialmedia = array(
                'facebook' => 'fab fa-facebook-f',
                'instagram' => 'fab fa-instagram',
                'twitter' => 'fab fa-twitter',
                'linkedin' => 'fab fa-linkedin',
                'youtube' => 'fab fa-youtube',
                'vimeo' => 'fab fa-vimeo',
              );
            @endphp
            <ul class="social-list">
                @foreach($socialmedia as $socialmedianame => $socialmediaicon)
                  @if($socialmedialinks->getValue($socialmedianame))
                    <li>
                      <a href="{{$socialmedialinks->getValue($socialmedianame)}}">
                        <i class="{{$socialmediaicon}}"></i>{{$socialmedianame}}
                      </a>
                    </li>
                  @endif
                @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-center">
                    <p>Copyright © 2021 erbaquest - All rights reserved</p>
                </div>
                <div class="col-md-6" style="
    text-align: right;
">
                    <img src="{{asset('images/Minimal-Credit-Card-Icons.png')}}" style="width: 200px">
                </div>
            </div>
        </div>
    </footer>
 <script src="{{ asset('js/front/app.js' ) }}"></script>
 <script type="text/javascript">
         $(document).ready(function(){

      setTimeout(function(){ 
        $(window).scroll(function(){
              var sticky = $('#masthead'),
                  scroll = $(window).scrollTop();

              if (scroll >= 100) sticky.addClass('fixed');
              else sticky.removeClass('fixed');
            });
       }, 3000);

      });
 </script>
  @stack('scripts')
  </body>
</html>