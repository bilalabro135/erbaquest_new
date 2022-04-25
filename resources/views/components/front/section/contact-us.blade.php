<div class="row">

  @if($fields)
      @foreach($fields as $location)
      <div class="col-sm-12 col-md-6">
          <div class="locate-box" style="background-image: url('{{(isset($location['background']) ) ? asset($location['background']) : '' }}');">
            <div class="deail">
              @if(isset($location['heading']))
                <h3>{!! $location['heading'] !!}</h3>
              @endif
               @if(isset($location['description']))
                <p>{!! $location['description'] !!}</p>
              @endif
          </div>
        </div>
      </div>
      @endforeach
    @else
      <p>NO Location Found!</p>
@endif 


</div>