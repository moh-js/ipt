@extends('layouts.dash')

@section('content')
<div class="callout callout-info">
  <h5>Assign Supervisors to students</h5>
  	<div class="col-6">
  		
  	</div>
		
	  <p class="col-10">Click the assign button to assign supervisor to students automatically.</p>

</div>

<div class="card">
	<div class="card-header">
		Setting
	</div>
	<div class="card-body">
		<form action="{{ route('admin.assign') }}" method="post" accept-charset="utf-8">
			@csrf

  			<div class="form-group row">
				<label for="num" class="col-md-4 col-form-label-sm">Students</label>

                <div class="col-md-6">
                    <input id="num" type="text" class="form-control col-6 form-control-sm {{ $errors->has('num') ? ' is-invalid' : '' }}" name="num" value="{{ old('num') }}" placeholder="No of students per supervisor" required autofocus>

                    @if ($errors->has('num'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('num') }}</strong>
                        </span>
                    @endif
                </div>
  			</div>

  			<div class="form-group row mt-2">
        		<div class="col-md-4"></div>
                <div class="col-md-6 ">
                    <button type="submit" class="btn btn-primary">
                        Assign
                    </button>
                </div>
            </div>

  		</form>
	</div>
</div>
@endsection