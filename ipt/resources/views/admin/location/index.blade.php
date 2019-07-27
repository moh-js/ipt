@extends('layouts.dash')

@section('css')

  <link rel="stylesheet" href="{{ asset('/public/assets/plugins/datatables/dataTables.bootstrap4.css') }}">

@endsection

@section('content')

<div class="card col-md-10">
	<div class="card-header">
	  <h3 class="card-title">Added Vacancies</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
	  <table id="example2" class="table table-sm">
	    <thead>
	    <tr>
	      <th>#</th>
	      <th>Industry Name</th>
	      <th>Region</th>
	      <th>Department</th>
	      <th>Vacancies</th>
	      <th>Action</th>

	    </tr>
	    </thead>
	    <tbody>
	    	@php $count = 1; @endphp
	    	@foreach($loc as $l)
		    <tr>
		      <td>{{ $count++ }}</td>
		      <td>{{ $l->name }}</td>
		      <td>{{ $l->region }}</td>
		      @php
		      	$departments = explode(",", $l->dep);
		      @endphp
		      <td>
		      	@foreach ($departments as $deparment)
		      		<span class="badge badge-primary">{{ $deparment }}</span>
		      	@endforeach
		      </td>
		      <td>{{ $l->vac }}</td>
		      <td class="text-center">
		      	<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
			      	<form action="{{ route('location.destroy', $l->id) }}" method="post" hidden>
		                @method('DELETE')
		                @csrf
		            </form>
		      	<a href="" title="" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
		      </td>
		    </tr>
		    @endforeach
		    @if(!count($loc))
	    		<tr>
	    			<td colspan="6" class="text-center text-info"><i class="fas fa-info mr-2"></i>There is no industry vacancy added</td>
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
