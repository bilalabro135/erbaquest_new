@extends('layouts.admin.app', ['title' => 'All Packages'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
         <h1 class="h3 mb-4 text-gray-800">All Packages</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Packages</h6>
                @can('addPackages')
                <a href="{{route('blogs.add')}}" class="btn btn-primary">Add New</a>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-light">
	                        <tr>
                            <th scope="col">ID</th>
					      <th scope="col">Package Name</th>
					      <th scope="col">Author</th>
					      <th scope="col">Price</th>
					      <th scope="col">Duration</th>
					      <th scope="col">Action</th>
						    </tr>
                        </thead>
                        <tfoot class="bg-primary text-light">
	                        <tr>
                            <th scope="col">ID</th>
					      <th scope="col">Package Name</th>
					      <th scope="col">Author</th>
					      <th scope="col">Price</th>
					      <th scope="col">Duration</th>
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
@endsection
@section('scripts')
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
		          url: "{{ route('packages.get') }}",
		          type: 'GET',
		         },
		         columns: [
		                  { data: 'id', name: 'id', 'visible': false},
		                  { data: 'name', name: 'name' },
		                  { data: 'author', name: 'author' },
		                  { data: 'price', name: 'price' },
		                  { data: 'duration', name: 'duration' },
		                  { data: 'action', name: 'action', orderable: true,searchable: true}
		               ],
		        order: [[0, 'desc']]
		  });
		  
		});
	</script>
@endsection
