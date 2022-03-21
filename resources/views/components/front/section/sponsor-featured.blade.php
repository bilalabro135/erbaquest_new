<section class="featuredSponsors" style="background-image: url('{{(isset($fields['background']) ) ? asset($fields['background']) : '' }}');">
  <div class="container-fluid">
    <h3 class="ft-blanka vc_heading text-center clr-white">
      Featured Sponsors
    </h3>
    <div class="ft-grids">
      <ul class="owl-carousel owl-theme">
        @foreach($sponsors as $sponsor)
         <li class="item">
            <img src="{{$sponsor->featured_image}}" alt="{{asset($sponsor->featured_image)}}">
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</section>