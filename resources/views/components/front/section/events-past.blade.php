<section class="pastEvents pt-65 pb-65" style="background-image: url('{{(isset($fields['background']) ) ? asset($fields['background']) : '' }}');">
  <div class="container">
    @if(isset($fields['heading']))
      <h3 class="ft-blanka vc_heading text-center clr-white">{!! $fields['heading'] !!}</h3>
    @else
      <h3 class="ft-blanka vc_heading text-center clr-white">Featured Events</h3>
    @endif
    <div class="row event-grids">
        <x-front.events.listing past="true" limit="4"/>
    </div>
  </div>
</section>
