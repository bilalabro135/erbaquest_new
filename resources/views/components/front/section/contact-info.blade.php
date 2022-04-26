 <div class="row ct-sect">
 	@if($fields)
    	@foreach($fields as $info)
			<div class="col-sm-12 col-md-4">
		    	<div class="info-box">
		      		<figure>
		        		<img src="{{asset($info['background'])}}">
		      		</figure>
		      		@if(isset($info['heading']))
		            	<h4>{!! $info['heading'] !!}</h4>
		          	@endif
		           	@if(isset($info['description']))
		            	<p>{!! $info['description'] !!}</p>
		          	@endif
		    	</div>
		  	</div>
  	    @endforeach
    @else
      <p>NO Info Found!</p>
	@endif 
</div>