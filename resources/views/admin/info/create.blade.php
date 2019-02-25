@extends('layouts.dash')

@section('content')

<div class="card card-info card-outline">
    <div class="card-header">
      <h3 class="card-title">
        Post News
      </h3>
      <!-- tools box -->
      <div class="card-tools">
        <button type="button" class="btn btn-tool btn-sm"
                data-widget="collapse"
                data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool btn-sm"
                data-widget="remove"
                data-toggle="tooltip"
                title="Remove">
          <i class="fa fa-times"></i>
        </button>
      </div>
      <!-- /. tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="mb-3">
      	<form method="POST" action="{{ route('info.store') }}" enctype="multipart/form-data">
            @csrf 
			
			<div class="form-group row">
                <label for="title" class="col-md-4 col-form-label-sm">Title</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control form-control-sm{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>                       
        
        	<div class="form-group row">
                <label for="attachment" class="col-md-4 col-form-label-sm">Attachment</label>

                <div class="col-md-6">
                    <input id="attachemnt" type="file" class="form-control-file {{ $errors->has('attachement') ? ' is-invalid' : '' }}" name="attach" value="{{ old('attachement') }}" autofocus>

                    @if ($errors->has('attachement'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('attachement') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        
        	<textarea id="editor1" name="description" style="width: 100%"></textarea>

        	<div class="form-group row mt-2">
                <div class="col-md-6 ">
                    <button type="submit" class="btn btn-primary">
                        Post
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

<!-- CK Editor -->
<script src="{{ asset('/assets/plugins/ckeditor/ckeditor.js') }}"></script>

{{-- Editor  --}}
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    ClassicEditor
      .create(document.querySelector('#editor1'))
      .then(function (editor) {
        // The editor instance
      })
      .catch(function (error) {
        console.error(error)
      })

    // bootstrap WYSIHTML5 - text editor

    $('.textarea').wysihtml5({
      toolbar: { fa: true }
    })
  })
</script>

@endsection