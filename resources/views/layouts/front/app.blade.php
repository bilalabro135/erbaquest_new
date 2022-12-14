<!DOCTYPE html>
<html lang="en">
  <head>

  <!-- HTML Meta Tags -->
<title>Erba Quest</title>
<meta name="description" content="Stay Lit. Stay Informed. We at ErbaQuest take pride in strengthening community relationships while entertaining and educating the masses. ">

<!-- Facebook Meta Tags -->
<meta property="og:url" content="https://erbaquest.com/">
<meta property="og:type" content="website">
<meta property="og:title" content="Erba Quest">
<meta property="og:description" content="Stay Lit. Stay Informed. We at ErbaQuest take pride in strengthening community relationships while entertaining and educating the masses. ">
<meta property="og:image" content="https://erbaquest.com//storage/photos/1/social.png">

<!-- Twitter Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta property="twitter:domain" content="erbaquest.com">
<meta property="twitter:url" content="https://erbaquest.com/">
<meta name="twitter:title" content="Erba Quest">
<meta name="twitter:description" content="Stay Lit. Stay Informed. We at ErbaQuest take pride in strengthening community relationships while entertaining and educating the masses. ">
<meta name="twitter:image" content="https://erbaquest.com//storage/photos/1/social.png">

<!-- Meta Tags Generated via https://www.opengraph.xyz -->


    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="firebase_ip" content="{{ route('notification.store') }}" >
    <title>Erba Quest</title>
        <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{$globalsettings->getValue('site_fav')}}">
    <!-- <link rel="manifest" href="manifest.json" /> -->
    <!-- PWA  -->
    <meta name="theme-color" content="#2c8e43"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <!-- <link rel="manifest" href="manifest.json" /> -->
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <!-- ios support -->

    <meta name="apple-mobile-web-app-status-bar" content="#2c8e43" />
    <meta name="theme-color" content="#2c8e43" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/front/primer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/front/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/front/owl.carousel.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('css/front/style.css') }}" />
    <script src="{{ asset('js/front/jquery.min.js' ) }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="{{ asset('js/front/bootstrap.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset('js/front/owl.carousel.min.js' ) }}" type="text/javascript"></script>
    <script src="https://kit.fontawesome.com/bf7b09a514.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="{{asset('js/front/jquery.mask.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{asset('js/front/custom.js') }}"></script>

    <!-- Google tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-233072646-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-233072646-1');
    </script>

  </head>

  <body>


@php
$user = auth()->user();
if(isset($user)){
  if ($user->isAn('Organizer') || $user->isAn('Vendor')){
@endphp
  <style type="text/css">
    .eventClass{
        display: block;
      }
  </style>
@php
  }else if($user->isAn('Vendor')){
@endphp
  <style type="text/css">
    .vendorClass{
        display: block;
      }
  </style>
@php
  }
}
@endphp

    <header id="masthead" class="site-header navbar-static-top navbar-light" role="banner">
      <div class="container">

        @if(isset($topbar) && !empty($topbar))
        <div class="topbar">
          <ul class="topbar-list">
            @foreach($topbar as $i => $menu)
              @if(Auth::check())
                @if($menu->visible_for_auth == 1)
                  <li class="{{(count($menu->children)) ? 'nav-item dropdown' : ''}}" id="{{$menu->attr_id}}">
                    <a href="{{ (count($menu->children)) ? 'javascript:;' : get_url($menu->link)}}" class="{{$menu->attr_class}} {{ (count($menu->children)) ? 'nav-link dropdown-toggle' : '' }}" {{ (count($menu->children) ) ? 'id="navbarDropdown'.$i.'" role="button" data-bs-toggle="dropdown" aria-expanded="false"' : '' }}>@if($menu->title =='[[auth_user]]')
                      {{ Auth::user()->name }}
                    @else
                      {{$menu->title}}
                      @endif
                  </a>
                     @if(count($menu->children))
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @foreach($menu->children as $menuchild)
                             <li id="{{$menuchild->attr_id}}" data-order="{{$menuchild->order}}"><a class="dropdown-item {{$menuchild->attr_class}}" href="{{get_url($menuchild->link)}}">{{$menuchild->title}}</a></li>
                        @endforeach
                      </ul>
                     @endif
                  </li>
                @endif
              @elseif(!Auth::check())
                @if($menu->visible_for_guest == 1)
                  <li class="" id="{{$menu->attr_id}}">
                    <a href="{{get_url($menu->link)}}" class="{{$menu->attr_class}}">{{$menu->title}}</a>
                  </li>
                @endif
              @endif
              @if($menu->visible_for_guest == 0 && $menu->visible_for_auth == 0)
                <li class="" id="{{$menu->attr_id}}">
                  <a href="{{get_url($menu->link)}}" class="{{$menu->attr_class}}">{{$menu->title}}</a>
                </li>
              @endif
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
              @if($globalsettings->getValue('footer_text'))
              <p>
                 {{$globalsettings->getValue('footer_text')}}
               </p>
              @endif
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
                    <p>Copyright ?? 2021 erbaquest - All rights reserved</p>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    <img src="{{asset('images/Minimal-Credit-Card-Icons.png')}}" style="width: 200px">
                </div>
            </div>
        </div>
    </footer>

<style type="text/css">

</style>

 <script src="{{ asset('js/front/app.js' ) }}"></script>

  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-analytics-compat.js"></script>
  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-messaging-compat.js"></script>
  <script src="{{ asset('js/pushnotification.js') }}"></script>

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

        // create event form Amenite checkbox
        $('.AmentieList .checkRight input:checkbox').change(function(){
            if($(this).is(":checked")) {
                $(this).parent().parent().addClass("checked");
            } else {
              $(this).parent().parent().removeClass("checked");
            }
        });
        // create event form vendor checkbox
       function myVendorsTags(vendorClass){
          if($("#"+vendorClass).is(":checked")) {
              $("#"+vendorClass).parent().parent().addClass("checked");
              var vendorName = $("#"+vendorClass).attr("data-name");
              var vendorVal  =  $("#"+vendorClass).val();
              $(".vendorTags").append('<li class="vendor_'+vendorVal+'"><span>'+ vendorName +'</span> <a href="javascript:void(0);" onclick="$(\'.vendor_'+vendorVal+'\').remove();$(\'#vendor_'+vendorVal+'\').parent().parent().removeClass(\'checked\');$(\'#vendor_'+vendorVal+'\').prop(\'checked\',false);"><i class="fas fa-times"></i></a></li>');

          } else {
              $("#"+vendorClass).parent().parent().removeClass("checked");
              var vendorVal  =  $("#"+vendorClass).val();
              $('.vendor_'+vendorVal).remove();
          }
       }

      $(".submit_btn").click(function(){
        $(".event_status").val("published");
        $(".front_event_create").submit();
      });
      $(".preview_btn").click(function(){
        $(".event_status").val("draft");
        $(".front_event_create").submit();
      });
      $(".update_submit_btn").click(function(){
        $(".event_status").val("published");
        $(".front_event_update").submit();
      });
      $(".preview_btn").click(function(){
        $(".event_status").val("draft");
        $(".front_event_update").submit();
      });
      //js
    $(".topbar .dropdown-toggle").click(function(){
      $(this).siblings().toggleClass("dropdown_toggle");
    });

    $(".vendor_list").click(function(){
      $('.VendorList').toggleClass('vendor_dropdown');
    });

    var $ul = $('.dropdown-menu');
    var $lis = $ul.find('li').sort(function(a, b) {
      return $(a).data('order') - $(b).data('order');
    });
    $lis.appendTo($ul);

    $(".rcVendor-list ul li:last-child").css("border-right", "0px");

// Mobile Toggle
$('button.navbar-toggler').on("click",function() {
  $('div#main-nav').slideToggle('collapse');
});

 </script>
  @stack('scripts')
  </body>
</html>
