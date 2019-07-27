@extends('layouts.dash')


@section('content')

<div class="card col-10">
	<div class="card-header">
		Assign Marks
	</div>
	<div class="card-body">
		<form action="{{ route('super.mark', $student->userId) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			
		  @csrf
	      <div class="form-group row">
	          <label for="indu_marks" class="col-md-4 col-form-label-sm text-md-right">{{ __('Industrial Marks') }}</label>

	          <div class="col-md-6">
	              <input id="indu_marks" type="text" class="form-control form-control-sm{{ $errors->has('indu_marks') ? ' is-invalid' : '' }}" name="indu_marks" value="{{ old('indu_marks') }}" required autofocus>

	              @if ($errors->has('indu_marks'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('indu_marks') }}</strong>
	                  </span>
	              @endif
	          </div>
	      </div>

	      <div class="form-group row">
	          <label for="uni_marks" class="col-md-4 col-form-label-sm text-md-right">{{ __('University Marks') }}</label>

	          <div class="col-md-6">
	              <input id="uni_marks" type="text" class="form-control form-control-sm{{ $errors->has('uni_marks') ? ' is-invalid' : '' }}" name="uni_marks" value="{{ old('uni_marks') }}" required autofocus>

	              @if ($errors->has('uni_marks'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('uni_marks') }}</strong>
	                  </span>
	              @endif
	          </div>
	      </div>

	      <div class="form-group row">
	          <label for="uni_file" class="col-md-4 col-form-label-sm text-md-right">{{ __('University file') }}</label>

	          <div class="col-md-6">
	              <input id="uni_file" name="uni_file" type="file" required autofocus><small class="text-danger">PDF</small>

	              @if ($errors->has('uni_file'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('uni_file') }}</strong>
	                  </span>
	              @endif
	          </div>
	      </div>

	      <div class="form-group row">
	          <label for="indu_file" class="col-md-4 col-form-label-sm text-md-right">{{ __('Industrial file') }}</label>

	          <div class="col-md-6">
	              <input id="indu_file" name="indu_file" type="file" required autofocus><small class="text-danger">PDF</small>

	              @if ($errors->has('indu_file'))
	                  <span class="invalid-feedback" role="alert">
	                      <strong>{{ $errors->first('indu_file') }}</strong>
	                  </span>
	              @endif
	          </div>
	      </div>

	      <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Submit') }}
                  </button>
              </div>
          </div>
			
		</form>
	</div>
</div>

@endsection