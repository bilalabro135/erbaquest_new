    <section class="featuredEvents">
      <div class="container">
        @if(isset($fields['heading']))
          <h3 class="ft-blanka vc_heading vc_heading-green text-center">{!! $fields['heading'] !!}</h3>
        @else
          <h3 class="ft-blanka vc_heading vc_heading-green text-center">Featured Events</h3>
        @endif
        <div class="row event-grids">
          <x-front.events.listing />

        </div>
      </div>
    </section>