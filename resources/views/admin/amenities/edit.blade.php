@extends('layouts.admin.app', ['title' => 'Edit Amenity'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif


         <div class="row">
         	@can('updateAmenities')
		    	<div class="col-md-12">
		    		<form class="user" action="{{route('amenities.update', ['amenity' => $amenity->id])}}" method="POST">
		    			@csrf
		    		<div class="card shadow">
		    			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                	<h6 class="m-0 font-weight-bold text-primary">Edit Amenity</h6>		              
			            </div>
			            <div class="card-body">
			            	<div class="row">
			            		
				            	<div class="col-md-12">		            		
					            	<div class="form-group">
					            		<label for="name">Name*</label>
					            		<input type="text" required="" name="name" value="{{ (old('name')) ? old('name') : $amenity->name }}" id="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
					            		@error('name')
					            			{{$message}}
					            		@enderror
					            	</div>
				            	</div>
				            	<div class="col-md-12">		    
				            		<div class="form-group">
				            			<label for="icon">Icon</label>
			                            <input type="hidden" id="icon" value="{{$amenity->icon}}" name="icon">
			                            <div class="file-upload lfm" id="lfm" data-input="icon" data-preview="lfm" >
			                                @empty($amenity->icon)
			                                    Upload Image
			                                @else
			                                     <img src="{{$amenity->icon}}" style="height: 5rem;">
			                                @endif
			                               
			                            </div>
			                            @error('icon')
			                                <div class="text-danger">
			                                    {{$message}}                                            
			                                </div>
			                            @endif
			                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
			                        </div>
				            	</div>
			            	</div>
			            	 <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Update') }}
                                </button>
                            </div>
			            </div>
		    		</div>
			    	</form>
		    	</div>
         	@endcan

         </div>

    </div>



@endsection


@section('scripts')

<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

<script>

    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('.lfm').filemanager('image', {prefix: route_prefix});
    function removeImage() {
        $('#icon').val('');
        $('#lfm').html('Upload')
    }
</script>

@endsection