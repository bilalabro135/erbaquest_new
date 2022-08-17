@extends('layouts.admin.app', ['title' => 'All Vendors'])



@section('content')
    <div class="container" id="page-top">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
         <h1 class="h3 mb-4 text-gray-800">All Vendors</h1>
         <a href="{{route('admin.vendor.category.add')}}" class="link"></a>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Vendors</h6>
                <a href="{{route('admin.vendor.category.add')}}" class="btn btn-sm btn-primary float-right">Add new</a>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-light">
	                        <tr>
						      <th scope="col" width="80%">Name</th>
						      <th scope="col">Actions</th>
						    </tr>
                        </thead>
                        <tfoot class="bg-primary text-light">
	                        <tr>
						      <th scope="col" width="80%">Name</th>
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
		          url: "{{ route('admin.vendor.category.get') }}",
		          type: 'GET',
		         },
		         columns: [
		                  { data: 'name', name: 'name' },
		                  { data: 'action', name: 'action' },
		               ],
		        order: [[0, 'desc']]
		  });
		  
		});
	</script>
@endsection