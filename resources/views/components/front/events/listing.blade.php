@foreach($events as $event)
<?php  
// echo "<pre>";
// print_r($event);
// exit();
?>
<div class="col-sm-12 col-md-6">
  <div class="event-box">
    <figure>
      <img src="{{asset($event->featured_image)}}">
    </figure>
    <div class="detail">
      <h4>{{$event->name}}</h4>
      <div class="ev-meta">
        <p class="date">
          <i class="far fa-calendar-alt"></i>
          {{$event->event_date}}
        </p>
        <p class="tags">
        </p>
      </div>
      <div class="text">
        {!!$event->description!!}
      </div>
      <div class="ev-info">
        @if($pageSlug != '')
        <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $event->id])}}">Details</a>
        @endif
        @if(!empty($event->organizer->name))
        <h5>{{$event->organizer->name}} <img src="{{(isset($event->organizer->profile_image)) ? $event->organizer->profile_image : asset('/images/avatar.png')}}"></h5>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach
@if($loadmore)
<div class="col-sm-12">
  <div class="loadMore">
    <button class="btn-custom load-more" type="button"><span style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Load More</button>
  </div>
</div>
@endif
@if($loadmore)
@push('scripts')
  <script type="text/javascript">
    var limit = {{$limit}};
    var offset = {{$offset}};
    $('.load-more').on('click', function(){
      let elem = $(this);
      offset+= limit;
      $.ajax({
        type: "GET",
        url: "{{route('events.loadmore')}}",
        data: {'offset': offset, 'limit': limit, 'upcoming': {{($upcoming)?$upcoming:'false'}}, 'featured': {{($featured) ? $featured : 'false'}} },
        cache: false,
        beforeSend: function(){
           $('.load-more span').fadeIn();
        },
        success: function(data){
          if(data['html'] != ''){
            $(data['html']).insertBefore($(elem).parents('section').find('.col-sm-12:not(.col-md-6)'));
          }
          if (!data['loadmore']) {
            $(elem).parents('section').find('.load-more').attr('disabled', 'disabled');
            $(elem).parents('section').find('.load-more').text('No More Data To Load');
            $(elem).parents('section').find('.load-more').css({'opacity': '60%', 'pointer-events': 'none'});
          }
        }
      }).done(function(){        
           $(elem).parents('section').find('.load-more span').fadeOut();
      });
    })
  </script>
@endpush
@endif