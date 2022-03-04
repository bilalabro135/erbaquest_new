    <section class="secEventsList pb-65">
      <div class="container">
        <div class="row ft-event">
          @foreach($events as $event)
          <div class="col-sm-12 col-md-4">
            <div class="event-box_list">
              <figure>
                <div class="wishlist">
                  <a href="javascript:;" class="heart-link"><i class="far fa-heart"></i></a>
                  <p class="ft-tag">Featured</p>
                </div>
                <img src="{{asset($event->featured_image)}}" alt="{{$event->name}}">
                <div class="author">
                  <p>{{$event->area}}</p>
                  <div class="figure">
                    <img src="{{($event->organizer->profile_image != '') ? $event->organizer->profile_image : asset('images/avatar.png') }}" alt="{{$event->organizer->name}}">
                  </div>
                </div>
              </figure>
              <div class="detail">
                <h3>{{$event->name}}</h3>
                <p class="date"><i class="far fa-calendar-alt"></i>{{$event->event_date}}</p>
                <div class="txt">
                  <p>{!!$event->description!!}</p>
                </div>
                @if($pageSlug != '')
                <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $event->id])}}" class="link">Details</a>
                @endif
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
</section>