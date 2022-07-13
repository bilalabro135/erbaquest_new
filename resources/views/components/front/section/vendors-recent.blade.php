<section class="recentVendors pt-65 pb-65">
  <div class="container">
    @if(isset($fields['heading']))
      <h3 class="ft-blanka vc_heading vc_heading-green text-center">{!! $fields['heading'] !!}</h3>
    @else
      <h3 class="ft-blanka vc_heading vc_heading-green text-center">Featured Brands</h3>
    @endif
    <div class="rcVendor-list">
      <ul>
        @foreach($vendors as $vendor)
        <li>
          <a href="{{ url('vendors/'.$vendor->id) }}">
            <img src="{{(isset($vendor->featured_picture)) ? $vendor->featured_picture : asset('images/avatar.png')}}" alt="{{$vendor->public_profile_name}}">
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</section>
