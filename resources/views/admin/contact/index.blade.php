@extends('layouts.admin.app', ['title' => 'Contact'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif


         <div class="row">
         	@can('addNewsletter')
		    	<!-- <div class="col-md-12">
		    		<form class="user" action="{{route('amenities.store')}}" method="POST">
		    			@csrf
		    		<div class="card shadow">
		    			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                	<h6 class="m-0 font-weight-bold text-primary">Add Newslter</h6>		              
			            </div>
			            <div class="card-body">
			            	<div class="row">
			            		
				            	<div class="col-md-12">		            		
					            	<div class="form-group">
					            		<label for="name">Name*</label>
					            		<input type="text" required="" name="name" value="{{old('name')}}" id="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
					            		@error('name')
					            			{{$message}}
					            		@enderror
					            	</div>
				            	</div>
				            	<div class="col-md-12">		            		
					            	<div class="form-group">
					            			<label for="icon">Icon</label>
				                            <input type="hidden" id="icon" name="icon">
				                            <div class="file-upload lfm" id="lfm" data-input="icon" data-preview="lfm" >
				                                Upload Image
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
                                    {{ __('Add') }}
                                </button>
                            </div>
			            </div>
		    		</div>
			    	</form>
		    	</div> -->
         	@endcan


         	<div class="col-md-12 mt-5">
         		         <h1 class="h3 mb-4 text-gray-800">All Contact</h1>
         		<div class="card shadow mb-4">
		            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                <h6 class="m-0 font-weight-bold text-primary">All Contact</h6>
		            </div>
		            <div class="card-body">
		            	<div class="main_sortBar">
		            		<label>Filter By:</label>
		            		<select name="type" class="form-control rolefileder">
		            			<option value=""></option>
		            			<option value="sponser" @if( app('request')->input('type') == 'sponser') selected="selected" @endif>Sponsor</option>
		            			<option value="general" @if( app('request')->input('type') == 'general') selected="selected" @endif>General</option>
		            		</select>
		            	</div>
		                <div class="table-responsive">
		                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                        <thead class="bg-primary text-light">
			                        <tr>
		                            <th scope="col">ID</th>
							      	<th scope="col">First Name</th>
							      	<th scope="col">Last Name</th>
							      	<th scope="col">Email</th>
							      	<th scope="col">Subject</th>
							      	<th scope="col">Message</th>
							      <th scope="col">Actions</th>
								    </tr>
		                        </thead>
		                        <tfoot class="bg-primary text-light">
			                        <tr>
		                            <th scope="col">ID</th>
							      	<th scope="col">First Name</th>
							      	<th scope="col">Last Name</th>
							      	<th scope="col">Email</th>
							      	<th scope="col">Subject</th>
							      	<th scope="col">Message</th>
							      <th scope="col">Actions</th>
								    </tr>
		                        </tfoot>
		                        <tbody>
		                        </tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
         	</div>

         </div>

    </div>
@endsection
@section('scripts')
<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
	<script type="text/javascript">
		$(document).ready( function () {
		   $.ajaxSetup({
		      headers: {
		          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		      }
		  });
		 
		  $('#dataTable').DataTable({
		         processing: true,
		         serverSide: true,
		         ajax: {
		          url: "{{ route('contact.get') }}?type={{ app('request')->input('type') }}",
		          type: 'GET',
		         },
		         columns: [
		                  { data: 'id', name: 'id', 'visible': false},
		                  { data: 'first_name', name: 'first_name' },
		                  { data: 'last_name', name: 'last_name' },
		                  { data: 'email', name: 'email' },
		                  { data: 'subject', name: 'subject' },
		                  { data: 'message', name: 'message' },
		                  { data: 'action', name: 'action', orderable: true,searchable: true}
		               ],
		        order: [[0, 'desc']]
		  });
		});

	</script>

	<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>

	<script>

	    var route_prefix = "{{route('unisharp.lfm.show')}}";
	    $('.lfm').filemanager('image', {prefix: route_prefix});
	    function removeImage() {
	        $('#icon').val('');
	        $('#lfm').html('Upload')
	    }

	    $(document).ready(function(){
			$(".rolefileder").change(function(){
		        value = $(this).val();
		        window.location.href = "{{ route('admin.contact') }}"+'?type='+value;
		    });
		});
	</script>
@endsection

