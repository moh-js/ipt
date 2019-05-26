@extends('layouts.dash')

@section('css')

@endsection

@section('content')

<div class="card card-info card-outline col-md-10" id=location>
    <div class="card-header">
      <h3 class="card-title">
        Add Industrial Vaccancie
      </h3>
      <!-- tools box -->
      <div class="card-tools">
        <button type="button" class="btn btn-tool btn-sm"
                data-widget="collapse"
                data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /. tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="mb-3">
      	<form method="POST" action="{{ route('location.store') }}" enctype="multipart/form-data">
            @csrf 
			
			<div class="form-group row">
                <label for="name" class="col-md-4 col-form-label-sm">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control form-control-sm {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div> 

            <div class="form-group row">
                <label for="dep" class="col-md-4 col-form-label-sm">Department</label>

                <div class="col-md-6">
                    <select class="form-control form-control-sm select2" multiple="multiple" data-placeholder="Select a Department" name="dep[]" 
                          style="width: 100%;">
                    <option value="archtecture">Archtecture</option>
                    <option value="civil">Civil</option>
                    <option value="computer">Computer</option>
                    <option value="electrical">Electrical</option>
                    <option value="lab">Lab</option>
                    <option value="mechanical">Mechanical</option>
                    <option value="sbm">SBM</option>
                  </select>

                    @if ($errors->has('dep'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('dep') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="region" class="col-md-4 col-form-label-sm">Region</label>

                <div class="col-md-6">
                    <div class="form-group">
                      <select  @change="getDi()" v-model="region_id" name="region" class="form-control form-control-sm select2" style="width: 100%;">
                        <option selected="selected">Choose Region...</option>
                        <option v-for="region in regions" :value="region.id"  :key="region.id">@{{region.name}}</option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <div class="form-group row" style="display: none;" id="district">
                <label for="district" class="col-md-4 col-form-label-sm">District</label>

                <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control form-control-sm " style="width: 100%;" name="district">
                        <option selected="selected">Choose District...</option>
                        <option v-for="district in districts" :value="district.name">@{{district.name}}<option>
                      </select>
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <div class="form-group row">
                <label for="vac" class="col-md-4 col-form-label-sm">No. of Vaccancies</label>

                <div class="col-md-6">
                    <input id="vac" type="text" class="form-control form-control-sm  {{ $errors->has('vac') ? ' is-invalid' : '' }}" name="vac" value="{{ old('vac') }}" required autofocus>

                    @if ($errors->has('vac'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('vac') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                      
        
        	<div class="form-group row mt-2">
        		<div class="col-md-4"></div>
                <div class="col-md-6 ">
                    <button type="submit" class="btn btn-primary">
                        Add
                    </button>
                </div>
            </div>

        </form>
      </div>
   	</div>
</div>
          <!-- /.card -->

@endsection

@section('script')
<script src="{{ asset('/public/custom/js/app.js') }}" type="text/javascript"></script>
<script>
    

    new Vue({
        el:'#location',
        data:{
            regions:[],
            districts:[],
            region_id:''
        },
        methods:{
            getRegions(){
                axios.get('/ipt_ms/regions').then(resp=>{
                    this.regions = resp.data
                })
            },
            getDi(){
                axios.get('/ipt_ms/districts/'+this.region_id).then(resp=>{
                    this.districts = resp.data
                })

                var district = document.getElementById('district');
                district.style = 'display:show;';

            }
        },
        created(){
            this.getRegions()
        }
    })

</script>

@endsection