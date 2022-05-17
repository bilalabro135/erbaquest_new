@extends('layouts.admin.app', ['title' => 'All Vendors'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
         <h1 class="h3 mb-4 text-gray-800">All Vendors</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Vendors</h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-light">
	                        <tr>
						      <th scope="col">Profile Name</th>
						      <th scope="col">Email</th>
						      <th scope="col">Actions</th>
						    </tr>
                        </thead>
                        <tfoot class="bg-primary text-light">
	                        <tr>
						      <th scope="col">Profile Name</th>
						      <th scope="col">Email</th>
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
		          url: "{{ route('admin.vendor.get') }}?role_id={{ app('request')->input('role_id') }}",
		          type: 'GET',
		         },
		         columns: [
		                  { data: 'public_profile_name', name: 'public_profile_name' },
		                  { data: 'email', name: 'email' },
		                  { data: 'action', name: 'action' },
		               ],
		        order: [[0, 'desc']]
		  });
		  
		});
	</script>
@endsection