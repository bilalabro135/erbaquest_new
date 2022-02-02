@extends('layouts.admin.app', ['title' => 'All Areas'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif


         <div class="row">
         	@can('addAreas')
		    	<div class="col-md-12">
		    		<form class="user" action="{{route('areas.store')}}" method="POST">
		    			@csrf
		    		<div class="card shadow">
		    			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                	<h6 class="m-0 font-weight-bold text-primary">Add Area</h6>		              
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
			            	</div>
			            	 <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary btn-block px-5">
                                    {{ __('Add') }}
                                </button>
                            </div>
			            </div>
		    		</div>
			    	</form>
		    	</div>
         	@endcan

         	@can('viewAreas')
         	<div class="col-md-12 mt-5">
         		         <h1 class="h3 mb-4 text-gray-800">All Areas</h1>
         		<div class="card shadow mb-4">
		            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                <h6 class="m-0 font-weight-bold text-primary">All Areas</h6>
		              s
		            </div>
		            <div class="card-body">
		                <div class="table-responsive">
		                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                        <thead class="bg-primary text-light">
			                        <tr>
		                            <th scope="col">ID</th>
							      <th scope="col">Name</th>
							      <th scope="col">Actions</th>
								    </tr>
		                        </thead>
		                        <tfoot class="bg-primary text-light">
			                        <tr>
		                            <th scope="col">ID</th>
							      <th scope="col">Name</th>
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

         	@endcan
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
		          url: "{{ route('areas.get') }}",
		          type: 'GET',
		         },
		         columns: [
		                  { data: 'id', name: 'id', 'visible': false},
		                  { data: 'name', name: 'name' },
		                  { data: 'action', name: 'action', orderable: true,searchable: true}
		               ],
		        order: [[0, 'desc']]
		  });
		});

	</script>

	<script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
@endsection

