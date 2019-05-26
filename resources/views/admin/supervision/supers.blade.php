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
	      <th>Department</th>
	      <th>Phone #</th>
	      <th># of Student</th>
	      <th>Region admitted</th>
	      <th>Action</th>

	    </tr>
	    </thead>
	    <tbody>
	    	@php $count = 1; use App\SuperHasStudent; @endphp
	    	@foreach($supers as $key => $super)
		    <tr>
		      <td>{{ $count++ }}</td>
		      <td>{{ $super->name }}</td>
		      <td>{{ title_case($super->department) }}</td>
		      <td>{{ isset($super->phone)? $super->phone:'0xxx xxx xxx' }}</td>
		      <td class="text-center">{{ $super->super_has_student->count() }}</td>
		      
		      @php
		      	$region = SuperHasStudent::where('super_id', $super->id)->first();
		      @endphp
		      
		      <td>{{ $region->student->region }}</td>
		      <td class="text-center">
		      	<a href="{{ route('admin.supervision.edit', $super->id) }}" class="text-info mr-2"><span><i class="fas fa-edit"></i></a>
		      	<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="text-danger"><i class="fas fa-trash-alt"></i></a>
			      	<form action="{{ route('admin.supervisor.delete', $super->id) }}" method="post" hidden>
		                @csrf
		            </form>
		      </td>
		    </tr>
		    @endforeach
		    @if(!count($supers))
	    		<tr>
	    			<td colspan="6" class="text-center text-info"><i class="fas fa-info mr-2"></i>There is no Supervisor assigned to student</td>
	    		</tr>
	    	@endif
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
      "autoWidth": false
    });
  });
</script>

@endsection
