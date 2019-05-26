@extends('layouts.dash')

@section('css')

@php $segment3 = $logbook->user->userId @endphp
@endsection

@section('content')
@if(!$logbook->marked)
<div class="row col-md-10">

  <div class="col-md-6">
	<div class="card card-outline card-primary">
		<div class="card-header">
			Students Data
		</div>
		<div class="card-body">
			<div class="row">
				<p class="text-right text-dark col"><strong>Full Name:</strong></p><p class="text-left col"> {{ $logbook->user->name }}</p>
			</div>
			<div class="row">
				<p class="text-right text-dark col"><strong>Registration No:</strong></p><p class="text-left col"> {{ $logbook->user->userId }}</p>
			</div>
			<div class="row">
				<p class="text-right text-dark col"><strong>Logbook name:</strong></p><p class="text-left col"> {{ $logbook->logbook }} <a  target="_blank"  href="{{ route('logbook.open', $logbook->user_id) }}" class=" ml-3 badge badge-primary"><i class="far fa-eye"></i></a></p>
			</div>
			<div class="row">
				<p class="text-right col"><strong>Report name:</strong></p><p class="text-left col"> {{ $logbook->report }} <a  target="_blank"  href="{{ route('report.open', $logbook->user_id) }}" class=" ml-3 badge badge-primary"><i class="far fa-eye"></i></a></p>
			</div>
		</div>
	</div>
  </div>
  
  	{{--  --}}
  <div class="col-md-6">
	<div class="card card-outline card-success">
		<div class="card-header">
			Marks
		</div>
		<div class="card-body">
			<form action="{{ route('logbook.store', $logbook->user_id) }}" method="post">
				@csrf
				<div class="form-group row">
	                <label for="marks" class="col-md-4 col-form-label text-md-right">Marks</label>

	                <div class="col-md-6">
	                    <input id="marks" type="text" class="form-control{{ $errors->has('marks') ? ' is-invalid' : '' }}" name="marks" required autofocus @if(isset($user)) disabled value="{{ $user->marks_name }}" @else value="{{ old('marks') }}" @endif>

	                    @if ($errors->has('marks'))
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $errors->first('marks') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>

                <div class="form-group row">
	                <div class="col-md-6 offset-md-4">
	                    <button type="submit" class="btn btn-primary">
	                        Assign
	                    </button>
	                </div>
	            </div>

			</form>
		</div>
	</div>
  </div>
	
</div>

@else

<p class="alert alert-danger alert-dismissible fade show" role="alert"">Student is already marked
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true"><i class="fas fa-times"></i></span>
  </button>
</p>
<p>
	<a href="{{ route('logbook.show') }}" class="btn btn-primary">Back</a>
</p>

@endif


@endsection
