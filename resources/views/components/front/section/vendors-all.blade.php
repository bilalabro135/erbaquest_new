<section class="vendors_box_section">
	<div class="container">
		<h3 class="ft-blanka vc_heading vc_heading-green text-center">VENDORS</h3>
        	<div class="amenties_filter">
	         	<ul>
		            @foreach($categories as $category)
		            	<li>
		              		<label class="clcikalert" style="padding-left: 25px;">
			                	<span class="text">{{$category->name}}</span>
			                	<input type="checkbox" name="category[]" value="{{$category->id}}">
		              		</label>
		            	</li>
		            @endforeach
	          	</ul>
        	</div>
		</select>
		<div class="row existingRecord">
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
    $('.amenties_filter li input').change(function(){
        if($(this).is(':checked')){
            $(this).parent('label').addClass('selected');
        }
        else{
            $(this).parent('label').removeClass('selected');                
        }
    })
</script>
<script type="text/javascript">
    $(".clcikalert input").click(function() {

		  var checked = [];
		  $.each($("input[name='category[]']:checked"), function(){
		      checked.push($(this).val());
		  });
		  $.ajaxSetup({
		      headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		      }
		  });
		  $.ajax({
		    url:'{{route("admin.categories.filter")}}',
		    type:'POST',
		    data: 'keys='+checked,
		    beforeSend: function() {
		    	$(".existingRecord").empty();
		    },
		    success:function(data) {
		    	$(".existingRecord").empty();
		    	$( ".existingRecord").html(data);
		    }
		 });

		});
</script>