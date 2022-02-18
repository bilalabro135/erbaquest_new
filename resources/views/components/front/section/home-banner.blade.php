<section class="sec-Banner" style="background-image: url('{{(isset($fields['background']) ) ? $fields['background'] : '' }}');">
  <div class="container">
    <div class="head-socialIcons">
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
      <ul>
          @foreach($socialmedia as $socialmedianame => $socialmediaicon)
            @if($socialmedialinks->getValue($socialmedianame))
              <li>
                <a href="{{$socialmedialinks->getValue($socialmedianame)}}">
                  <i class="{{$socialmediaicon}}"></i>
                </a>
              </li>
            @endif
          @endforeach
      </ul>
    </div>
    <div class="banner-text">
      @if(isset($fields['heading']))
      <h1 class="ft-blanka">{!! $fields['heading'] !!}</h1>
      @endif
      @if(isset($fields['description']))
      <p>{!! $fields['description'] !!}</p>
      @endif
      @if(isset($fields['cta_action']))
      <a class="btn-custom" href="{{$fields['cta_action']}}">{{ (isset($fields['cta_text'])) ? $fields['cta_text'] : $fields['cta_action'] }}</a>
      @endif
    </div>
    <div class="banner-sponsors">
      <div class="text">
        <h3 class="ft-blanka">SPONSORS <span class="arrow-right">
          <img src="images/right_arrow.png">
        </span></h3>
      </div>
      <div class="logos">
        <ul class="owl-carousel owl-theme">
          <li class="item">
            <img src="images/sponsor-1.png">
          </li>
          <li class="item">
            <img src="images/sponsor-2.png">
          </li>
          <li class="item">
            <img src="images/sponsor-3.png">
          </li>
          <li class="item">
            <img src="images/sponsor-4.png">
          </li>
          <li class="item">
            <img src="images/sponsor-5.png">
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>
