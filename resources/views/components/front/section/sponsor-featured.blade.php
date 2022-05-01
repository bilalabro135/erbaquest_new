<section id="featured_sponsors" class="featuredSponsors" style="background-image: url('{{(isset($fields['background']) ) ? asset($fields['background']) : '' }}');">
  <div class="container-fluid">
    <h3 class="ft-blanka vc_heading text-center clr-white">
      Featured Sponsors
    </h3>
    <div class="ft-grids">
      <ul class="owl-carousel owl-theme">
        @foreach($sponsors as $sponsor)
         <li class="item">
             @if($sponsor->external_url)
                 <a target="_blank" href="{{ $sponsor->external_url }}"><img src="{{asset($sponsor->featured_image)}}" alt="{{asset($sponsor->featured_image)}}"></a>
             @else
                 <img src="{{asset($sponsor->featured_image)}}" alt="{{asset($sponsor->featured_image)}}">
             @endif
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</section>
