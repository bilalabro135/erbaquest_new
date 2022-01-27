@extends('layouts.admin.app', ['title' => 'All Categories'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif

         <h1 class="h3 mb-4 text-gray-800">All Categories</h1>
         <div class="row">
         	@can('addCategories')
		    	<div class="col-md-4">
		    		<form class="user" action="{{route('categories.store')}}" method="POST">
		    			@csrf
		    		<div class="card shadow">
		    			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                	<h6 class="m-0 font-weight-bold text-primary">Add Category</h6>		              
			            </div>
			            <div class="card-body">
			            	<div class="form-group">
			            		<label for="name">Name*</label>
			            		<input type="text" name="name" value="{{old('name')}}" id="name" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
			            		@error('name')
			            			{{$message}}
			            		@enderror
			            	</div>
			            	<div class="form-group">
			            		<label for="slug">Slug*</label>
			            		<input type="text" name="slug" id="slug" value="{{old('slug')}}" placeholder="Slug" class="form-control @error('slug') is-invalid @enderror">
			            		@error('slug')
			            			{{$message}}
			            		@enderror
			            	</div>
			            	<div class="form-group">
			            		<label for="parent_id">Parent Category</label>
			            		<select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
			            			<option value="">Select Parent Category</option>
			            			@foreach($parent_cats as $parent)
			            				<option value="{{$parent->id}}">{{$parent->name}}</option>
			            			@endforeach
			            		</select>
			            		@error('parent_id')
			            			{{$message}}
			            		@enderror
			            	</div>
			            	<div class="form-group">
			            		<label for="description">Description</label>
			            		<textarea style="height: 100px;" type="text" name="description" id="description" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
			            		@error('description')
			            			{{$message}}
			            		@enderror
			            	</div>

                            <input type="hidden" id="featured_image" name="featured_image">
                            <div class="file-upload" id="lfm" data-input="featured_image" data-preview="lfm" >
                                Upload Image
                            </div>
                            @error('featured_image')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
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
         	@can('viewCategories')
         	<div class="col-md-8">
         		<div class="card shadow mb-4">
		            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
		              
		            </div>
		            <div class="card-body">
		                <div class="table-responsive">
		                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                        <thead class="bg-primary text-light">
			                        <tr>
		                            <th scope="col">ID</th>
							      <th scope="col">Category Name</th>
								  <th scope="col">Parent</th>
							      <th scope="col">Action</th>
								    </tr>
		                        </thead>
		                        <tfoot class="bg-primary text-light">
			                        <tr>
		                            <th scope="col">ID</th>
							      <th scope="col">Category Name</th>
								  <th scope="col">Parent</th>
							      <th scope="col">Action</th>
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
		          url: "{{ route('categories.get') }}",
		          type: 'GET',
		         },
		         columns: [
		                  { data: 'id', name: 'id', 'visible': false},
		                  { data: 'name', name: 'name' },
		                  { data: 'parent', name: 'parent' },
		                  { data: 'action', name: 'action', orderable: true,searchable: true}
		               ],
		        order: [[0, 'desc']]
		  });
		$('#name').blur(function (e) {
            if ($('#slug').val() == '') {
                $('#slug').val(
                $(this).val().toLowerCase()
                 .replace(/[^\w ]+/g, '')
                 .replace(/ +/g, '-')
                );
            }
        })
		});
		    var route_prefix = "{{route('unisharp.lfm.show')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix});
    function removeImage() {
        $('#featured_image').val('');
        $('#lfm').html('Upload')
    }
	</script>
@endsection
