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
                <img src="{{$event->featured_image}}" alt="{{$event->name}}">
                <div class="author">
                  <p>San Diego. CA</p>
                  <div class="figure">
                    <img src="{{$event->organizer->profile_image}}" alt="{{$event->organizer->name}}">
                  </div>
                </div>
              </figure>
              <div class="detail">
                <h3>{{$event->name}}</h3>
                <p class="date"><i class="far fa-calendar-alt"></i>{{$event->event_date}}</p>
                <div class="txt">
                  <p>{!!$event->description!!}</p>
                </div>
                <a href="javascript:;" class="link">DETAIL</a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
</section>