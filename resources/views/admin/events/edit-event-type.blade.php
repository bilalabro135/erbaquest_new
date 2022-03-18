@extends('layouts.admin.app', ['title' => 'Edit Event Type'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif


         <div class="row">
         	@can('updateAreas')
		    	<div class="col-md-12">
		    		<form class="user" action="{{route('areas.update', ['area' => $area->id])}}" method="POST">
		    			@csrf
		    		<div class="card shadow">
		    			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                	<h6 class="m-0 font-weight-bold text-primary">Edit area</h6>		              
			            </div>
			            <div class="card-body">
			            	<div class="row">
			            		
				            	<div class="col-md-12">		            		
					            	<div class="form-group">
					            		<label for="name">Name*</label>
					            		<input type="text" required="" name="name" value="{{ (old('name')) ? old('name') : $area->name }}" id="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
					            		@error('name')
					            			{{$message}}
					            		@enderror
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
