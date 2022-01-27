@extends('layouts.admin.app', ['title' => 'Edit Category'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif

         <h1 class="h3 mb-4 text-gray-800">Edit Category</h1>
         <div class="row">
         	@can('updateCategories')
		    	<div class="col-md-8">
		    		<form class="user" action="{{route('categories.update', ['category' => request('category')])}}" method="POST">
		    			@csrf
		    			<input type="hidden" name="old_slug" value="{{$category->slug}}">
		    		<div class="card shadow">
		    			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                	<h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>		              
			            </div>
			            <div class="card-body">
			            	<div class="form-group">
			            		<label for="name">Name*</label>
			            		<input type="text" name="name" id="name" value="{{ (old('name')) ? old('name') : $category->name }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror">
			            		@error('name')
			            			{{$message}}
			            		@enderror
			            	</div>
			            	<div class="form-group">
			            		<label for="slug">Slug*</label>
			            		<input type="text" name="slug" value="{{ (old('slug')) ? old('slug') : $category->slug }}" id="slug" placeholder="Slug" class="form-control @error('slug') is-invalid @enderror">
			            		@error('slug')
			            			{{$message}}
			            		@enderror
			            	</div>

			            	<div class="form-group">
			            		<label for="parent_id">Parent Category</label>
			            		<select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
			            			<option value="">Select Parent Category</option>
			            			@foreach($parent_cats as $parent)
			            				<option value="{{$parent->id}}" {{($category->parent_id == $parent->id) ? 'selected' : ''}}>{{$parent->name}}</option>
			            			@endforeach
			            		</select>
			            		@error('parent_id')
			            			{{$message}}
			            		@enderror
			            	</div>
			            	<div class="form-group">
			            		<label for="description">Description</label>
			            		<textarea style="height: 100px;" type="text" name="description" id="description" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{ (old('description')) ? old('description') : $category->description }}</textarea>
			            		@error('description')
			            			{{$message}}
			            		@enderror
			            	</div>
			            	<input type="hidden" id="featured_image" value="{{$category->featured_image}}" name="featured_image">
                            <div class="file-upload" id="lfm" data-input="featured_image" data-preview="lfm" >
                                @empty($category->featured_image)
                                    Upload Image
                                @else
                                     <img src="{{$category->featured_image}}" style="height: 5rem;">
                                @endif
                               
                            </div>
                            @error('featured_image')
                                <div class="text-danger">
                                    {{$message}}                                            
                                </div>
                            @endif
                            <a href="javascript:void(0)" class="text-danger mt-2 d-inline-block" onclick="removeImage()">Remove Image</a>
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
	<script type="text/javascript">
		$(document).ready( function () {

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
