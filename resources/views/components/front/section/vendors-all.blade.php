<section class="vendors_box_section">
	<div class="container">
		<h3 class="ft-blanka vc_heading vc_heading-green text-center">VENDORS</h3>
        	<div class="amenties_filter">
	         	<ul>
	         		<li class="all">
	            		<label class="clcikalert allCat selected" style="padding-left: 25px;">
		                	<span class="text">All</span>
		                	<input type="checkbox" name="all" class="example" value="all">
	              		</label>
	              	</li>
		            @foreach($categories as $category)
		            	<li class="filter">
		              		<label class="clcikalert" style="padding-left: 25px;">
			                	<span class="text">{{$category->name}}</span>
			                	<input type="checkbox" name="category[]" value="{{$category->id}}">
		              		</label>
		            	</li>
		            @endforeach
	          	</ul>
			<div class="myAjaxLoader" style="width: 110px;position: absolute;left: 0px;margin-top: -110px;"><img src="{{asset('images/icons/loader-waiting.gif')}}"></div>
        </div>
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
    $('.filter input').change(function(){
        if($(this).is(':checked')){
            $(this).parent('label').addClass('selected');
            $('.allCat input').parent('label').removeClass('selected');
        }
        else{
            $(this).parent('label').removeClass('selected');
        }
    });

    $('.allCat input').change(function(){
        if($(this).is(':checked')){
            $(this).parent('label').addClass('selected');
            $('.filter input').parent('label').removeClass('selected');
        }
        else{
            $(this).parent('label').removeClass('selected');
        }
    });
</script>

<script type="text/javascript">
$('input.example').on('change', function() {
  $('input.example').not(this).prop('checked', false);
});

</script>

<script type="text/javascript">
	$(".myAjaxLoader").hide();
    $(".clcikalert input").click(function() {
		  var checked	= [];
		  $.each($("input[name='category[]']:checked"), function(){
		      checked.push($(this).val());
		  });
		  $.each($("input[name='all']:checked"), function(){
		  		var checked	= [];
		  		var checked	= "all";
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
		    	$(".myAjaxLoader").show();
		    },
		    success:function(data) {
		    	$(".existingRecord").empty();
		    	$(".myAjaxLoader").hide();
		    	if (data) {
		    		$(".existingRecord").html(data);
		    	}else{
		    		$(".existingRecord").html("<h2 class='text-center text-secondary'>NO VENDOR FOUND..!!</h2>");
		    	}
		    }
		 });
		});
</script>
