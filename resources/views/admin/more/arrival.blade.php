@extends('layouts.dash')

@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Regions</div>
			<div class="card-body">
				<p>
					@foreach ($regions as $region)
						@php
							$region->name = str_replace('/', '-', $region->name);
						@endphp
						<a href="{{ route('info.arrival.id', $region->name) }}" class="text-center">
							<span class="badge badge-primary">{{ str_before($region->name, 'Region') }}</span>
						</a>
					@endforeach
				</p>
			</div>
		</div>
	</div>

	<div class="col-md-6 text">
		<div class="card">
			<div class="card-header">@if(isset($id)) {{ str_before($id, 'Region') }} @endif Details</div>
			<div class="card-body">
				@if (isset($re))
					<table class="table table-sm">
							<thead>
								<tr>
									<th>Department</th>
									<th>No of students</th>
								</tr>
							</thead>
							<tbody>
		

								@foreach ($re as $key => $r)
									<tr>
										<td>{{ title_case($key) }}</td>
										<td>{{ $r }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>	

						<p class="text-right"><strong>Total:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong>{{ count($arrival) }}</p>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')

@endsection