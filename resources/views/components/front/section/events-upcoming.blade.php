<section class="UpcomingEvents featuredEvents" style="background-image: url('{{(isset($fields['background']) ) ? asset($fields['background']) : '' }}');">
  <div class="container">
    @if(isset($fields['heading']))
      <h3 class="ft-blanka vc_heading text-center clr-white">{!! $fields['heading'] !!}</h3>
    @else
      <h3 class="ft-blanka vc_heading text-center clr-white">Upcoming Events</h3>
    @endif
    <div class="row event-grids">
        <x-front.events.listing limit="4" upcoming="true"/>
    </div>
  </div>
</section>
