@foreach($events as $event)
<div class="col-sm-12 col-md-6">
  <div class="event-box">
    <figure>
      <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $event->id])}}">
      <img src="{{asset($event->featured_image)}}">
      </a>
    </figure>
    <div class="detail">
      <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $event->id])}}"><h4>{{$event->name}}</h4></a>
      <div class="ev-meta">
        @if( !$event['is_recurring'] )
             <p class="date">
                <i class="far fa-calendar-alt"></i>
                {{date('m-d-Y', strtotime($event['event_date']))}}
            </p>
       @else
            <p> <b>Day:</b> {{ $event['day_dropdown'] }} <b>Type:</b> {{ $event['recurring_type'] }} </p>
       @endif

        <p class="tags">
          @if( $event['featured'] )
            <span>Featured</span>
          @endif
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
        <h5>
          {{$event->organizer->name}}

          <img src="{{(isset($event->organizer->profile_image)) ? $event->organizer->profile_image : asset('/images/avatar.png')}}">
        </h5>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach
@if($loadmore)
<div class="col-sm-12">
  <div class="loadMore">
      @if($featured)
          <button data-offset="4" class="btn-custom load-more-featured" type="button"><span style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Load More</button>
      @elseif($upcoming)
          <button data-offset="4" class="btn-custom load-more-upcoming" type="button"><span style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Load More</button>
      @elseif($past)
          <button data-offset="4" class="btn-custom load-more-past" type="button"><span style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Load More</button>
      @else
          <button class="btn-custom load-more" type="button"><span style="display: none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Load More</button>
      @endif
  </div>
</div>
@endif
@if($loadmore)
    @if($featured)
        @push('scripts')
            <script type="text/javascript">
                var limit = {{$limit}};
                //var offset = {{$offset}};
                $('.load-more-featured').on('click', function(){
                    var offset = $(this).attr("data-offset");
                    $(this).attr("data-offset",parseInt(offset) + 4);
                    let elem = $(this);
                    //offset+= limit;
                    $.ajax({
                        type: "GET",
                        url: "{{route('events.loadmore')}}",
                        data: {'offset': offset, 'limit': limit, 'featured': {{($featured) ? $featured : 'false'}} },
                        cache: false,
                        beforeSend: function(){
                            $('.load-more-featured span').fadeIn();
                        },
                        success: function(data){
                            if(data['html'] != ''){
                                $(data['html']).insertBefore($(elem).parents('section').find('.col-sm-12:not(.col-md-6)'));
                            }
                            if (!data['loadmore']) {
                                $(elem).parents('section').find('.load-more-featured').attr('disabled', 'disabled');
                                $(elem).parents('section').find('.load-more-featured').text('No More Data To Load');
                                $(elem).parents('section').find('.load-more-featured').css({'opacity': '60%', 'pointer-events': 'none'});
                            }
                        }
                    }).done(function(){
                        $(elem).parents('section').find('.load-more-featured span').fadeOut();
                    });
                })
            </script>
        @endpush
    @elseif($upcoming)
        @push('scripts')
            <script type="text/javascript">
                var limit = {{$limit}};
                //var offset = {{$offset}};
                $('.load-more-upcoming').on('click', function(){
                    var offset = $(this).attr("data-offset");
                    $(this).attr("data-offset",parseInt(offset) + 4);
                    let elem = $(this);
                    $.ajax({
                        type: "GET",
                        url: "{{route('events.loadmore')}}",
                        data: {'offset': offset, 'limit': limit, 'upcoming': {{($upcoming)?$upcoming:'false'}} },
                        cache: false,
                        beforeSend: function(){
                            $('.load-more-upcoming span').fadeIn();
                        },
                        success: function(data){
                            if(data['html'] != ''){
                                $(data['html']).insertBefore($(elem).parents('section').find('.col-sm-12:not(.col-md-6)'));
                            }
                            if (!data['loadmore']) {
                                $(elem).parents('section').find('.load-more-upcoming').attr('disabled', 'disabled');
                                $(elem).parents('section').find('.load-more-upcoming').text('No More Data To Load');
                                $(elem).parents('section').find('.load-more-upcoming').css({'opacity': '60%', 'pointer-events': 'none'});
                            }
                        }
                    }).done(function(){
                        $(elem).parents('section').find('.load-more-upcoming span').fadeOut();
                    });
                })
            </script>
        @endpush
    @elseif($past)
        @push('scripts')
            <script type="text/javascript">
                var limit = {{$limit}};
                //var offset = {{$offset}};
                $('.load-more-past').on('click', function(){
                    var offset = $(this).attr("data-offset");
                    $(this).attr("data-offset",parseInt(offset) + 4);
                    let elem = $(this);
                    //offset+= limit;
                    $.ajax({
                        type: "GET",
                        url: "{{route('events.loadmore')}}",
                        data: {'offset': offset, 'limit': limit, 'past': {{($past)?$past:'false'}} },
                        cache: false,
                        beforeSend: function(){
                            $('.load-more-past span').fadeIn();
                        },
                        success: function(data){
                            if(data['html'] != ''){
                                $(data['html']).insertBefore($(elem).parents('section').find('.col-sm-12:not(.col-md-6)'));
                            }
                            if (!data['loadmore']) {
                                $(elem).parents('section').find('.load-more-past').attr('disabled', 'disabled');
                                $(elem).parents('section').find('.load-more-past').text('No More Data To Load');
                                $(elem).parents('section').find('.load-more-past').css({'opacity': '60%', 'pointer-events': 'none'});
                            }
                        }
                    }).done(function(){
                        $(elem).parents('section').find('.load-more-past span').fadeOut();
                    });
                })
            </script>
        @endpush
    @endif
@endif
