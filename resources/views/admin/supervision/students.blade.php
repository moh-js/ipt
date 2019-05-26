@extends('layouts.dash')

@section('css')

  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('content')

<div class="card col-md-10">
	<div class="card-header">
	  <h3 class="card-title">Students Arrival Note</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	  <table id="example2" class="table table-sm">
	    <thead>
	    <tr>
	      <th>#</th>
	      <th>Name</th>
	      <th>Industry Name</th>
	      <th>Region</th>
	      <th>Department</th>

	    </tr>
	    </thead>
	    <tbody>
	    	@php $count = 1; @endphp
	    	@foreach($arrivals as $key => $arrival)
		    <tr>
		      <td>{{ $count++ }}</td>
		      <td>{{ $arrival->user->name }}</td>
		      <td>{{ $arrival->industry_name }}</td>
		      <td>{{ $arrival->region }}</td>
		      <td>{{ $arrival->department }}</td>
		    </tr>
		    @endforeach
		    @if(!count($arrivals))
	    		<tr>
	    			<td colspan="6" class="text-center text-info"><i class="fas fa-info mr-2"></i>There is no students arrival note submitted</td>
	    		</tr>
	    	@endif
		</tbody>
	  </table>
	  {{-- <div class="row mt-5">
	      <div class="ml-auto">
		  	{{ $arrivals->links() }}
		  </div>
	  </div> --}}
	</div>
</div>


@endsection

@section('script')

<!-- DataTables -->
<script src="{{ asset('/public/assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/public/assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
  });
</script>

@endsection
