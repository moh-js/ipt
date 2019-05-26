@extends('layouts.dash')

@section('css')

  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('content')

<div class="card col-md-10">
	<div class="card-header">
	  <h3 class="card-title"><strong>{{ $super->super->name }}</strong> assigned Students </h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	  <table id="example2" class="table table-sm">
	    <thead>
	    <tr>
	      <th>#</th>
	      <th>Reg #</th>
	      <th>Student Name</th>
	      <th>District</th>
	      <th>Action</th>

	    </tr>
	    </thead>
	    <tbody>
	    	@php $count = 1; @endphp
	    	@foreach($super_has_students as $student)
		    <tr>
		      <td>{{ $count++ }}</td>
		      <td>{{ $student->student->user->userId }}</td>
		      <td>{{ $student->student->user->name }}</td>
		      <td>{{ $student->student->region }}</td>
		      <td class="text-center">
		      	<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="text-danger"><i class="fas fa-trash-alt"></i></a>
			      	<form action="{{ route('admin.supervision.student.delete', $student->student_id) }}" method="post" hidden>
		                @csrf
		            </form>
		      </td>
		    </tr>
		    @endforeach
{{-- 		    @if(!count($news))
	    		<tr>
	    			<td colspan="6" class="text-center text-info"><i class="fas fa-info mr-2"></i>There is no any News added</td>
	    		</tr>
	    	@endif --}}
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
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false
    });
  });
</script>

@endsection
