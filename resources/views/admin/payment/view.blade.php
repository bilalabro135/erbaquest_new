@extends('layouts.admin.app', ['title' => 'Payments'])
@section('content')
    <div class="container">
        @if(session('msg'))
        <div class="alert alert-{{session('msg_type')}}">
            {{session('msg')}}                                            
        </div>
        @endif
         <div class="row">
         	<div class="col-md-12 mt-5">
         		         <h1 class="h3 mb-4 text-gray-800">All Payments</h1>
         		<div class="card shadow mb-4">
		            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		                <h6 class="m-0 font-weight-bold text-primary">All Payments</h6>
		              s
		            </div>
		            <div class="card-body">
		                <div class="table-responsive">
		                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		                        <thead class="bg-primary text-light">
			                      <tr>
		                            <th>Transaction ID</th>
				                    <th>Amount</th>
				                    <th>Status</th>
							       </tr>
		                        </thead>
		                        <tbody>
		                        	@if($transactionDatas)
			                        	@foreach($transactionDatas as $transactionData)
					                      <tr>
					                            <td>{{ $transactionData['id'] }}</td>
					                            <td>{{ $transactionData['amount'] }}</td>
					                            <td>{{ $transactionData['status'] }}</td>
					                      </tr>
					                    @endforeach
					                @else
					                <tr>
					                	<td colspan="3">
					                		NO Transaction Found.    
					                	</td>
					                </tr>
					                @endif
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

	<script type="text/javascript">
	</script>

@endsection

