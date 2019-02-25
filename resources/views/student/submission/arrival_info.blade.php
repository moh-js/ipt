@extends('layouts.dash')

@section('css')
	<link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
@endsection


@section('content')


<div class="card card-outline card-primary">
    <div class="card-header">
    	Arrival Form
    </div>

    <div class="card-body" id="arrival">
        <form method="POST" action="{{ route('arrival.store') }}">
            @csrf 

            <div class="form-group row">
                <label for="industry" class="col-md-4 col-form-label-sm text-md-right">Industry Name</label>

                <div class="col-md-6">
                    <input id="industry" type="text" class="form-control form-control-sm{{ $errors->has('industry') ? ' is-invalid' : '' }}" name="industry" required autofocus @if(isset($user)) disabled value="{{ $user->industry_name }}" @else value="{{ old('industry') }}" @endif>

                    @if ($errors->has('industry'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('industry') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label-sm text-md-right">Phone</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control form-control-sm{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" required autofocus @if(isset($user)) disabled value="{{ $user->phone }}" @else value="{{ old('phone') }}" @endif>

                    @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="region" class="col-md-4 col-form-label-sm text-md-right">Region</label>

                <div class="col-md-6">
                    <div class="form-group">
                      <select  @change="getDi()" v-model="region_id" name="region" class="form-control form-control-sm" style="width: 100%;" @if(isset($user)) disabled value="{{ $user->region }}" @else value="{{ old('region') }}" @endif>
                        <option selected="selected">Choose Region...</option>
                        @if(isset($user))
                         <option selected="selected">{{ $user->region }}</option>
                        @endif
                        <option v-for="region in regions" :value="region.id">@{{region.name}}</option>
                      </select>

                      @if ($errors->has('region'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('region') }}</strong>
                        </span>
                      @endif

                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <div class="form-group row">
                <label for="district" class="col-md-4 col-form-label-sm text-md-right">District</label>

                <div class="col-md-6">
                    <div class="form-group">
                      <select class="form-control form-control-sm" style="width: 100%;" name="district" @if(isset($user)) disabled value="{{ $user->district }}" @else value="{{ old('region') }}" @endif>
                        <option selected="selected">Choose District...</option>
                        @if(isset($user))
                         <option selected="selected">{{ $user->district }}</option>
                        @endif
                        <option v-for="district in districts" :value="district.name">@{{district.name}}<option>
                      </select>

                      @if ($errors->has('district'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('district') }}</strong>
                        </span>
                      @endif

                    </div>
                    <!-- /.form-group -->
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_super" class="col-md-4 col-form-label-sm text-md-right">Industrial Superviosr's Phone No</label>

                <div class="col-md-6">
                    <input id="phone_super" type="text" class="form-control form-control-sm{{ $errors->has('phone_super') ? ' is-invalid' : '' }}" name="phone_super" required autofocus @if(isset($user)) disabled value="{{ $user->phone_super }}" @else value="{{ old('phone_super') }}" @endif>

                    @if ($errors->has('phone_super'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('phone_super') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="location" class="col-md-4 col-form-label-sm text-md-right">Exact Location</label>

                <div class="col-md-6">
                	<input id="location" type="text" class="form-control form-control-sm{{ $errors->has('location') ? ' is-invalid' : '' }}" name="location" required autofocus @if(isset($user)) disabled value="{{ $user->location }}" @else value="{{ old('location') }}" @endif>
                	<small class="form-text text-muted">Optional</small>

                    @if ($errors->has('location'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('location') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            @if(is_null($user))
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-outline-primary">
                        Send
                    </button>
                </div>
            </div>
            @endif

        </form>
        <hr class="jumbotron-hr">
        
        <div>    
            @if(isset($user))
                <p class="text-info"><i class="fas fa-info-circle text-info pr-1"></i>
                    If you wish to change your arrival information click that button
                </p>

                <form action="{{ route('change.arrival') }}" method="post">
                    @csrf
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
                      <i class="far fa-edit pr-2 text-danger"></i>Change
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Arrival note</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p class="text-danger">
                               If you remove your arrival information you will have to send again your arrival information. 
                            </p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Remove</button>
                          </div>
                        </div>
                      </div>
                    </div>
                </form>

            @endif
        </div>

    </div>
</div>

@endsection

@section('script')

<script src="/custom/js/app.js" type="text/javascript"></script>
<script>

    new Vue({
        el:'#arrival',
        data:{
            regions:[],
            districts:[],
            region_id:''
        },
        methods:{
            getRegions(){
                axios.get('/get-regions').then(resp=>{
                    this.regions = resp.data
                })
            },
            getDi(){
                axios.get('/get-district/'+this.region_id).then(resp=>{
                    this.districts = resp.data
                })

            }
        },
        created(){
            this.getRegions()
        }
    })

</script>

@endsection