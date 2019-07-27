@extends('layouts.dash')

@section('css')

  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('content')

<div class="card card-outline card-primary col-md-10">
	<div class="card-header">
	  <h3 class="card-title">Students industry location</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	  <table id="example2" class="table table-sm ">
	    <thead>
	    <tr>
	      <th>#</th>
	      <th>Reg No</th>
	      <th>Industry Name</th>
	      <th>District</th>
	      <th>Action</th>

	    </tr>
	    </thead>
	    <tbody>
	    	@if(!count($students))
	    		<tr>
	    			<td colspan="6" class="text-center text-info"><i class="fas fa-info mr-2"></i>There is no student logbook available for marking</td>
	    		</tr>
	    	@endif
	    	@php $count = 1; @endphp
	    	@foreach($students as $student)
		    <tr>
		      <td>{{ $count++ }}</td>
		      <td>{{ $student->students->userId }}</td>
		      <td>{{ $student->student_arrival->industry_name }}</td>
		      <td>{{ $student->student_arrival->region }}</td>

		      <td class="text-center">
			      <a href="#"class="btn btn-sm btn-success{{--  @if(!$l) disabled @endif --}}"><i class="pr-2 fas fa-check"></i></a>	
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
      "autoWidth": true
    });
  });
</script>

@endsection
