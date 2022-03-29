@if($isEvent == false)
<section class="secSearchEvent">
  <div class="container">
    @if(isset($fields['heading']))
      <h3 class="ft-blanka vc_heading">{!! $fields['heading'] !!}</h3>
    @else
      <h3 class="ft-blanka vc_heading">Newsletter</h3>      
    @endif
    <div class="searchEvent">
      <form class="searchEventForm" action="{{route('pages.show', ['pages' => $action])}}" method="GET">
        <div class="input-field">
          <input type="text" name="search" value="{{$search}}"  placeholder="SEARCH">
        </div>
        <div class="input-field drop-arrow">
          <select name="location">
            <option value="" selected="selected">Location</option>
            @foreach($countries as $country)
            <option value="{{$country->name}}">{{$country->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field">
          <input type="submit" name="submit" value="SEARCH">
        </div>
      </form>
    </div>
  </div>
</section>
@else
<section class="secSearchEventListing pt-65 pb-65">
  <form class="" action="{{route('pages.show', ['pages' => $action])}}" method="GET">
  <div class="container">
    <div class="searchEvent">
      <div class="searchEventForm">
        <div class="input-field">
          <input type="text" name="search" value="{{$search}}"  placeholder="WHAT ARE YOU LOOKING FOR?">
        </div>
        <div class="input-field drop-arrow">
          <select name="location">
            <option value="" selected="selected">Location</option>
            @foreach($countries as $country)
              <option {{($location != '' && $country->name == $location) ? 'selected="selected"' : ''}} value="{{$country->name}}">{{$country->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field">
          <input type="submit" value="SEARCH">
        </div>
        </div>
    </div>
    <div class="SortFilter">
      <p>{{$events_count}} Result{{ ($events_count > 1) ? 's' : '' }} found</p>
      <div class="input-field customDropdown">
        <select class="sortDropdown" name="sort">
          <option value="">SORT BY</option>
          <option {{($sort != '' && $sort == 'latest') ? 'selected="selected"' : ''}} value="latest">Latest</option>
          <option {{($sort != '' && $sort == 'name') ? 'selected="selected"' : ''}} value="name">Name</option>
        </select>
      </div>
    </div>
  </div>
  </form>
</section>
@endif