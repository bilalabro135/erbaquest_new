<?php
	$explode = explode("/",$_SERVER['REQUEST_URI']);
	$second_last = $explode[count($explode)-2];
	$page = end($explode);
?>

<div class="col-sm-12 col-md-4">
  <div class="sidebar">
    <h3 class="clr-white text-center">DASHBORD</h3>
    <div class="sidebar-menu">
      <ul class="menu_list">
        <li class="<?php if($second_last.'/'.$page == 'account/edit'){ echo 'current'; } ?>">
          <a href="{{route('account.edit')}}">Account Setting</a>
        </li>
        @if( $users->role == 3 || $users->role == 2 )
        <li class="have_child-items <?php if($second_last.'/'.$page == 'events/my-event' || $second_last.'/'.$page == 'events/edit' || $second_last.'/'.$page == 'account/draft-events' || $second_last.'/'.$page == 'account/past-events' || $second_last.'/'.$page == 'account/upcoming-event'){ echo 'current'; } ?>">
          <span class="down-icon"><i class="fas fa-chevron-down"></i></span>
          <a href="{{route('my.event')}}">My Events</a>
          <ul class="sub-menu">
            <li class="item">
              <a href="{{route('events.create')}}">Add Event</a>
            </li>
            <li class="item">
              <a href="{{route('edit.event')}}">Edit Event</a>
            </li>
            <li class="item">
              <a href="{{route('draft.account')}}">Draft Event</a>
            </li>
            <li class="item">
              <a href="{{route('past.account')}}">My Past Events</a>
            </li>
            <li class="item">
              <a href="{{route('upcomming.account')}}">Upcoming Event</a>
            </li>
          </ul>
        </li>
        @endif
        @if( $users->role == 2 )
          <li class="<?php if($second_last.'/'.$page == 'account/public-profile'){ echo 'current'; } ?>">
            <a href="{{route('public.profile')}}">My Public Profile</a>
          </li>
          <li class="<?php if($second_last.'/'.$page == 'account/payment-list'){ echo 'current'; } ?>">
            <a href="{{route('payment.list')}}">Payment</a>
          </li>
          <li class="<?php if($second_last.'/'.$page == 'account/payment-option'){ echo 'current'; } ?>">
            <a href="{{route('payment.option')}}">Payment Option</a>
          </li>
        @endif

        <li class="<?php if($second_last.'/'.$page == 'account/wishlist'){ echo 'current'; } ?>">
          <a href="{{route('wishlist')}}">Wishlist</a>
        </li>
        <li>
          <a href="{{route('logout')}}">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</div>
