@extends('layouts.dash')

@section('css')

  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('content')

<div class="card card-outline card-primary">
	<div class="card-header">
	  Students Logbooks and Reports
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	  <table id="example2" class="table table-sm ">
	    <thead>
	    <tr>
	      <th>#</th>
	      <th>Reg No</th>
	      <th>Logbook</th>
	      <th>Report</th>
	      <th>Action</th>

	    </tr>
	    </thead>
	    <tbody>
	    	@if(!count($logbook))
	    		<tr>
	    			<td colspan="6" class="text-center text-info"><i class="fas fa-info mr-2"></i>There is no student logbook available for marking</td>
	    		</tr>
	    	@endif
	    	@php $count = 1; @endphp
	    	@foreach($logbook as $l)
		    <tr>
		      <td>{{ $count++ }}</td>
		      <td>{{ $l->user->userId }}</td>
		      <td>{{ $l->logbook }}</td>
		      <td>{{ $l->report }}</td>

		      <td class="text-center">
			      <a href="{{ route('logbook.mark', $l->user_id) }}"class="btn btn-sm btn-primary @if(!$l) disabled @endif"><i class="pr-2 fas fa-check"></i>Mark</a>	
		      </td>
		    </tr>
		    @endforeach
		</tbody>
	  </table>
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