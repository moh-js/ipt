@extends('layouts.dash')

@section('content')

<div class="card col-md-10">
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

<div class="card col-md-10">
  <div class="card-header">Delete</div>
  <div class="card-body">
    <p>If you wish to delete all the data of supervisors who assigned to students.</p>
    <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="text-danger"><i class="fas fa-trash-alt mr-2"></i>Delete</a>
      <form action="{{ route('admin.supervision.delete') }}" method="post" hidden>
          @csrf
      </form>
  </div>
</div>
@endsection