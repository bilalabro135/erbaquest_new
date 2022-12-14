@extends('layouts.admin.app', ['title' => 'All Users'])



@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
         <h1 class="h3 mb-4 text-gray-800">All Users</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
                @can('addUsers')
                <a href="{{route('users.add')}}" class="btn btn-primary">Add New</a>
                @endcan
            </div>
            <div class="card-body">
            	<div class="main_sortBar">
            		<label>Filter By:</label>
            		<select name="role_id" class="form-control rolefileder">
            			<option value=""></option>
            			<option value="4" @if( app('request')->input('role_id') == 4) selected="selected" @endif>Admin</option>
            			<option value="2" @if( app('request')->input('role_id') == 2) selected="selected" @endif>Vendor</option>
            			<option value="3" @if( app('request')->input('role_id') == 3) selected="selected" @endif>Organizer</option>
            		</select>

            	</div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-primary text-light">
	                        <tr>
						      <th scope="col">ID</th>
						      <th scope="col">Name</th>
						      <th scope="col">Email</th>
						      <th scope="col">Role</th>
						      <th scope="col">Action</th>
						    </tr>
                        </thead>
                        <tfoot class="bg-primary text-light">
	                        <tr>
						      <th scope="col">ID</th>
						      <th scope="col">Name</th>
						      <th scope="col">Email</th>
						      <th scope="col">Role</th>
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
		          url: "{{ route('users.get') }}?role_id={{ app('request')->input('role_id') }}",
		          type: 'GET',
		         },
		         columns: [
		                  { data: 'id', name: 'id', 'visible': false},
		                  { data: 'name', name: 'name' },
		                  { data: 'email', name: 'email' },
		                  { data: 'role', name: 'role',searchable: true },
		                  { data: 'action', name: 'action', orderable: true, searchable: true}
		               ],
		        order: [[0, 'desc']]
		  });
		  
		});
		$(document).ready(function(){
			$(".rolefileder").change(function(){
		        value = $(this).val();
		        window.location.href = "{{ route('users') }}"+'?role_id='+value;
		    });
		});
	</script>
@endsection