@extends('layouts.dash')

@section('css')

  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('content')

<div class="card col-md-10">
	<div class="card-header">
		Performance Result
	</div>
	<div class="card-body">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Reg No</th>
					<th>Name</th>
					<th>Total Marks</th>
				</tr>
			</thead>
			<tbody>
			@foreach($result as $r)	
				<tr>
					<td>{{ $r->user->userId }}</td>
					<td>{{ $r->user->name }}</td>
					<td>{{ $r->total }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="row justify-content-center">
	<div class="col-xl-1">
		<a title="Export data to pdf" class="btn btn-info disabled" href="{{ route('student.pdf') }}"><i class="fa-2x fas fa-file-pdf"></i></a>		
	</div>
	<div class="col-xl-1">
		<a title="Export data to excel" class="btn btn-success" href="{{ route('student.excel') }}"><i class="fa-2x fas fa-file-excel"></i></a>	
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