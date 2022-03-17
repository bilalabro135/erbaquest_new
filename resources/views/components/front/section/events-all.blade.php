    <section class="secEventsList pb-65">
      <div class="container">
        <div class="row ft-event">
          @foreach($events as $event)
          <div class="col-sm-12 col-md-4">
            <div class="event-box_list">
              <figure>
                <div class="wishlist">
                  <input type="hidden" value="{{$event->id}}" name="event_id" class="event_wish">
                  <a href="javascript:;" class="heart-link"><i class="far fa-heart"></i></a>
                  <p class="ft-tag">Featured</p>
                </div>
                  <img src="{{asset($event->featured_image)}}" alt="{{$event->name}}">
                <div class="author">
                  <p>{{$event->area}}</p>
                  @if(!empty($event->organizer->profile_image))
                  <div class="figure">
                    <img src="{{($event->organizer->profile_image != 'null') ? $event->organizer->profile_image : asset('images/avatar.png') }}" alt="{{$event->organizer->name}}">
                  </div>
                  @endif
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
<script>
$(".heart-link").click(function() {
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
  var event_id = $(this).prev(".event_wish").val(); 
	$.ajax({
	   url:'{{route("add.wishlist")}}',
	   type:'POST',
     data:'event_id='+event_id,
	   success:function(data) {
	     alert(data.msg);
	   }
	});
});
</script>