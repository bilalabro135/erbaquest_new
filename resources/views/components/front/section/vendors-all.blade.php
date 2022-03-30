<section class="vendors_box_section">
	<div class="container">
		<h3 class="ft-blanka vc_heading vc_heading-green text-center">VENDORS</h3>
		<div class="row">
			@if($vendors)
	            @foreach($vendors as $vendor)
					<div class="col-md-3">
						<div class="vendor_box">
							<a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $vendor['id']])}}">
			                	<img src="{{asset($vendor['featured_picture'])}}" alt="{{$vendor['public_profile_name']}}">
			                </a>
							<a href="{{route('posts.show', ['pages' => $pageSlug, 'id' => $vendor['id']])}}"><h3>{{$vendor['public_profile_name']}}</h3></a>
						</div>
					</div>
				@endforeach
          	@else
          	  <p>NO Events Found!</p>
          	@endif 
          	<div class="col-sm-12">
	            <div class="pagination">
	              {!! $vendors->render()  !!}
	            </div>
	        </div>
		</div>
	</div>
</section>