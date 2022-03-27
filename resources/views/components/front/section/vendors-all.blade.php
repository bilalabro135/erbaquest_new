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
	            	<ul>
						<li class="pg-nav"><i class="fas fa-chevron-left" aria-hidden="true"></i> PREV</li>
						<li>1</li>
						<li class="active">2</li>
						<li>3</li>
						<li>4</li>
						<li>5</li>
						<li>6</li>
						<li class="pg-nav">NEXT <i class="fas fa-chevron-right" aria-hidden="true"></i></li>
					</ul>
	            </div>
	        </div>
		</div>
	</div>
</section>