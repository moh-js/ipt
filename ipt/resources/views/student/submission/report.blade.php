@extends('layouts.dash')


@section('content')

<div class="card col-md-11 card-outline card-primary">
	<div class="card-header">Arrival Note Information</div>
	<div class="card-body">
		  <table class="table">
		  	<thead>
		  		<tr>
		  			<th>Industry Name</th>
		  			<th>Region</th>
		  			<th>District</th>
		  			<th>Phone #</th>
		  			<th>Industrial Supervisor Phone #</th>
		  			<th>Action</th>
		  		</tr>
		  	</thead>
		  	<tbody>
			  	@if (isset($user->arrival->industry_name))
			  	    <tr>
			  			<td>{{ $user->arrival->industry_name }}</td>
			  			<td>{{ $user->arrival->region }}</td>
			  			<td>{{ $user->arrival->district }}</td>
			  			<td>{{ $user->arrival->phone }}</td>
			  			<td>{{ $user->arrival->phone_super }}</td>
			  			<td>
			  				<a href="{{ route('sub.arrival') }}" class="text-primary" title="Edit"><span><i class="far fa-edit mr-2"></i></span></a>
			  				<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="text-danger " title="Delete"><span><i class="far fa-trash-alt"></i></span></a>
			  				<form action="{{ route('change.arrival') }}" method="post" hidden>
			                @csrf
			            </form>
			  			</td>
			  		</tr>
			  	@else
			  		<tr>
			  			<td colspan="6" class="text-center">No data</td>
			  		</tr>	
			  	@endif
		  	</tbody>
		  </table>
	</div>
</div>

<div class="card col-md-11 card-outline card-info">
	<div class="card-header">Logbook and Report</div>
	<div class="card-body">
		  <table class="table">
		  	<thead>
		  		<tr>
		  			<th>Logbook</th>
		  			<th>Report</th>
		  			<th>Date Submitted</th>
		  			<th>Action</th>
		  		</tr>
		  	</thead>
		  	<tbody>
			  	@if (isset($user->logbook->logbook))
			  	    <tr>
			  			<td><a href="{{ route('logbook.open', $user->logbook->user_id) }}" target="_blank" title="Open Logbook">{{ $user->logbook->logbook }}</a></td>
			  			<td><a href="{{ route('report.open', $user->logbook->user_id) }}" target="_blank" title="Open Logbook">{{ $user->logbook->report }}</a></td>
			  			<td>{{ Carbon\Carbon::parse($user->logbook->updated_at)->format('d m Y') }}</td>
			  			<td>
			  				<a href="{{ route('sub.arrival') }}" class="text-primary" title="Edit"><span><i class="far fa-edit mr-2"></i></span></a>
			  				<a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="text-danger " title="Delete"><span><i class="far fa-trash-alt"></i></span></a>
			  				<form action="{{ route('logbook.delete') }}" method="post" hidden>
			                @csrf
			            </form>
			  			</td>
			  		</tr>
			  	@else
			  		<tr>
			  			<td colspan="6" class="text-center">No data</td>
			  		</tr>	
			  	@endif
		  	</tbody>
		  </table>

	</div>
</div>

<div class="card col-md-11 card-outline card-danger">
	<div class="card-header">University Supervisor information</div>
	<div class="card-body">
		<table class="table">
		  	<thead>
		  		<tr>
		  			<th>Name</th>
		  			<th>Department</th>
		  			<th>Phone #</th>
		  		</tr>
		  	</thead>
		  	<tbody>
			  	@if (isset($user->arrival->assigned->super->name))
			  	    <tr>
			  			<td>{{ title_case($user->arrival->assigned->super->name) }}</td>
			  			<td>{{ title_case($user->arrival->assigned->super->department) }}</td>
			  			<td>{{ $user->arrival->assigned->super->phone }}</td>
			  		</tr>
			  	@else
			  		<tr>
			  			<td colspan="6" class="text-center">No data</td>
			  		</tr>	
			  	@endif
		  	</tbody>
		  </table>
	</div>
</div>

@endsection