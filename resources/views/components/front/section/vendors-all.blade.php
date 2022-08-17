<section class="vendors_box_section">
	<div class="container">
		<h3 class="ft-blanka vc_heading vc_heading-green text-center">VENDORS</h3>
		<select id="cat_id" class="form-control">
			@if($categories)
			<option selected>-- Please select --</option>
	            @foreach($categories as $key => $category)
					<option value="{{$key}}">{{$category}}</option>
				@endforeach
          	@endif
		</select>
		<h4 class="card-title"><img class="loader" src="{{asset('images/icons/loader-waiting.gif')}}" style="position: absolute;width: 140px;left: 0;display: none;"></span>
		<div class="row">
			@if($vendors)
	            @foreach($vendors as $vendor)
					<div class="col-md-3 existingRecord">
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
          	<div class="row data">
          	  	
          	</div> 
          	<div class="col-sm-12">
	            <div class="pagination">
	              {!! $vendors->render()  !!}
	            </div>
	        </div>
		</div>
	</div>
</section>
<script type="text/javascript">
    $('.loader').hide();
	$(document).on('change','#cat_id',function(){
        let cat_id = $(this).val();

        $.ajax({
            url:"{{route('admin.categories.filter')}}",
            method:"GET",
            data:{cat_id:cat_id},
            beforeSend:function(){
                $('.loader').show();
            },
            success:function(data){
            	console.log(data);
            	$('.loader').hide();
            	var len   = 0;
                $(".existingRecord").empty();
                $('.data').html(data);
        	}
    	});
    });
</script>