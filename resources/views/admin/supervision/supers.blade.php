@extends('layouts.dash')

@section('css')

  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('content')

<div class="card">
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
	      <th>Department</th>
	      <th>Phone #</th>
	      {{-- <th>Region admitted</th> --}}

	    </tr>
	    </thead>
	    <tbody>
	    	@php $count = 1; @endphp
	    	@foreach($supers as $key => $super)
		    <tr>
		      <td>{{ $count++ }}</td>
		      <td>{{ $super->name }}</td>
		      <td>{{ title_case($super->department) }}</td>
		      <td>{{ $super->phone }}</td>
		      {{-- <td>{{ $super->region }}</td> --}}
		    </tr>
		    @endforeach
		    @if(!count($supers))
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
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
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
