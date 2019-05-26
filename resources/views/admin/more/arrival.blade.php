@extends('layouts.dash')

@section('content')

<div class="row col-md-10" id="arrivals">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">Regions</div>
			<div class="card-body">
				<p>
					{{-- @foreach ($regions as $region)
						@php
							$region->name = str_replace('/', '-', $region->name);
						@endphp
						<a href="{{ route('info.arrival.id', $region->name) }}" class="text-center">
							<span class="badge badge-primary">{{ str_before($region->name, 'Region') }}</span>
						</a>
					@endforeach --}}
					
				
						<span class="mr-1 badge badge-primary" v-for="region in regions" v-on:click="arrivalData(region.name)"  style="cursor: pointer;">@{{ region.name }}</span>

				</p>
			</div>
		</div>
	</div>

	<div class="col-md-6 text">
		<div class="card">
			<div class="card-header">@{{ collection[1] }} Details</div>
			<div class="card-body">

					<table class="table table-sm">
							<thead>
								<tr>
									<th>Department</th>
									<th>No of students</th>
								</tr>
							</thead>
							<tbody>
		{{-- 

								@foreach ($re as $key => $r)
									<tr>
										<td>{{ title_case($key) }}</td>
										<td>{{ $r }}</td>
									</tr>
								@endforeach --}}

								<tr v-for="department, index in collection[2]" >
									<td>@{{ index }}</td>
									<td>@{{ department }}</td>
								</tr>

							</tbody>
						</table>	

						<p class="text-right"><strong>Total:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong>@{{ totalStudent.length }}</p>

			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="{{ asset('/public/custom/js/app.js') }}" type="text/javascript"></script>
<script>
    

    new Vue({
        el:'#arrivals',
        data:{
            regions:[],
            collection:[],
            totalStudent:[],
        },
        methods:{
            getRegions(){
                axios.get('/ipt_ms/regions').then(resp=>{
                    this.regions = resp.data
                })
            },
            arrivalData: function(region_id){
            	region_id = region_id.replace("/", "_")
                axios.get("/ipt_ms/dashboard/arrival/information/"+region_id).then(resp=>{
                    this.collection = resp.data
                })

                totalStudent = this.collection[0]

            }
        },
        created(){
            this.getRegions()
        }
    })

</script>
@endsection