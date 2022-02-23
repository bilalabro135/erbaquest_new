<section class="recentVendors pt-65 pb-65">
  <div class="container">
    @if(isset($fields['heading']))
      <h3 class="ft-blanka vc_heading vc_heading-green text-center">{!! $fields['heading'] !!}</h3>
    @else    
      <h3 class="ft-blanka vc_heading vc_heading-green text-center">Recent Vendors</h3>
    @endif
    <div class="rcVendor-list">
      <ul>
        @foreach($vendors as $vendor)
        <li>
          <img src="{{(isset($vendor->profile_image)) ? $vendor->profile_image : asset('images/avatar.png')}}" alt="{{$vendor->name}}">
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</section>