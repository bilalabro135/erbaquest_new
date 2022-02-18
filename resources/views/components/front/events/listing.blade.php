@foreach($events as $event)
<div class="col-sm-12 col-md-6">
  <div class="event-box">
    <figure>
      <img src="{{$event->featured_image}}">
    </figure>
    <div class="detail">
      <h4>{{$event->name}}</h4>
      <div class="ev-meta">
        <p class="date">
          <i class="far fa-calendar-alt"></i>
          {{$event->event_date}}
        </p>
        <p class="tags">
          <span>Dummy</span>
          <span>Dummy</span>
        </p>
      </div>
      <div class="text">
        {!!$event->description!!}
      </div>
      <div class="ev-info">
        <a href="javascript:;">Details</a>
        <h5>{{$event->organizer->name}} <img src="{{(isset($event->organizer->profile_image)) ? $event->organizer->profile_image : asset('/images/avatar.png')}}"></h5>
      </div>
    </div>
  </div>
</div>
@endforeach
<div class="col-sm-12">
  <div class="loadMore">
    <button class="btn-custom" type="button">Load More</button>
  </div>
</div>