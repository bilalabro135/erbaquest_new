    <section class="secEventsList pb-65">
      <div class="container"> <!-- $selectedParameter -->
        <div class="row ft-event">
          <div class="alert alert-success">
             Added To <a href='{{route("wishlist")}}'>WishLists</a>
             <a href="#" class="close_sucesss">x</a>
          </div>
          <div class="alert alert-danger">
             Event has been removed from Wishlist!
             <a href="#" class="close_sucesss">x</a>
          </div>
          <div class="main_all_events row">
              @if($events)
                @foreach($events as $event)
                <div class="col-sm-12 col-md-4">
                  <div class="event-box_list" id="event_{{$event['id']}}">
                    <figure>
                      <div class="wishlist">
                        <input type="hidden" value="{{$event['id']}}" name="event_id" class="event_wish">

                          <a href="javascript:;" class="heart-link">
                            @if($event['isWishList'])
                              <i class="fas fa-heart"></i>
                            @else
                              <i class="far fa-heart"></i>
                            @endif
                          </a>
                         @if($event['featured'])
                          <p class="ft-tag">Featured</p>
                         @endif
                      </div>
                      <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $event['id']])}}">
                          @if($event['featured_image'])
                            <img src="{{asset($event['featured_image'])}}" alt="{{$event['name']}}">
                          @else
                            <img src="{{asset('images/placeholder.jpg')}}" alt="{{$event['name']}}">
                          @endif
                      </a>
                       <div class="author">
                        <p>{{$event['area']}}</p>
                        @if(!empty($event['user_profile']))
                        <div class="figure">
                          <img src="{{ $event['user_profile'] }}" >
                        </div>
                        @else
                        <div class="figure">
                          <img src="{{asset('images/avatar.png')}}">
                        </div>
                        @endif
                      </div>
                    </figure>
                    <div class="detail">
                      <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $event['id']])}}">
                        <h3>{{$event['name']}}</h3>
                      </a>
                      @if(!$event['is_recurring'])
                        <p class="date"><i class="far fa-calendar-alt"></i>{{date('m-d-Y', strtotime($event['event_date']))}}</p>
                      @else
                            <p><b>Day:</b> {{ $event['day_dropdown'] }} <b>Type:</b> {{ $event['recurring_type'] }}</p>
                      @endif
                      <div class="txt">
                        <p>{!!$event['description']!!}</p>
                      </div>
                      @if($pageSlug != '')
                      <a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $event['id']])}}" class="link">Details</a>
                      @endif
                    </div>
                  </div>
                </div>
                @endforeach
              @else
                <p>NO Events Found!</p>
              @endif
          </div>
        </div>
      </div>
</section>
<script>

$(".heart-link").click(function() {
  $(".alert").hide();
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
    beforeSend: function() {
      $(".heart-link").addClass('disabled-link');
    },
    success:function(data) {
      if(data){
        if(data.action == "add"){
          $(".event_wish").addClass("addedwishlist");
          $("#event_"+event_id).find('.fa-heart').removeClass('far');
          $("#event_"+event_id).find('.fa-heart').addClass('fas');
          $(".alert-success").show();
        }else if(data.action == "remove"){
          $(".event_wish").removeClass("addedwishlist");
          $("#event_"+event_id).find('.fa-heart').removeClass('fas');
          $("#event_"+event_id).find('.fa-heart').addClass('far');
          $(".alert-danger").show();
        }else if(data.action == "redirect"){
          //console.log(data.action);
           window.location=data.url;
        }

        setTimeout(function() {
          $(".alert").hide();
        }, 2500);
      }
      $(".heart-link").removeClass('disabled-link');
     }
  });
});


$(".clcikalert input").click(function() {


  var checked = [];
  $.each($("input[name='amenties[]']:checked"), function(){
      checked.push($(this).val());
  });

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
    url:'{{route("search.event")}}',
    type:'POST',
    data:'checkedData='+checked,
    beforeSend: function() {

    },
    success:function(data) {
      if(data){
        const queryString = window.location.search = data;
      }else{
        const queryString = window.location.search = "";
      }
    }
  });

});

$('.sortDropdown').change(function(){
  var data= $(this).val();
    const queryString = window.location.search;
    if(queryString){
        window.location.search = "&sort="+data;
    }else{
        window.location.search = "?sort="+data;
    }
});

// const queryString = window.location.search = "?name=2";
//   console.log(queryString);

//   $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//   });
//   var event_id = $(this).prev(".event_wish").val();
//   $.ajax({
//     url:'{{route("add.wishlist")}}',
//     type:'POST',
//     data:'event_id='+event_id,
//     beforeSend: function() {

//     },
//     success:function(data) {
//       console.log(data);
//      }
//   });

$(".close_sucesss").click(function() {
  event.preventDefault();
  $(this).parent().hide();
});
</script>
