@extends('layouts.dash')

@section('content')

<div class="col-md-10	">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">Read News</h3>
      <div class="card-tools">
        <a href="@if($prev) {{ URL::to( 'dashboard/news/read/' . $prev ) }} @else # @endif" class="btn btn-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
        <a href="@if($next) {{ URL::to( 'dashboard/news/read/' . $next ) }} @else # @endif" class="btn btn-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="mailbox-read-info">
        <h5>{{ $news->title }}</h5>
        <h6>From: {{ $news->user->title }}
          <span class="mailbox-read-time float-right">{{ Carbon\Carbon::parse($news->created_at)->format('d-M. Y g:i A') }}</span></h6>
        
      </div>
    
      <div class="mailbox-read-message">
        
        {!! $news->description !!}

        <p>Thanks,<br>{{ $news->user->name }}</p>
      </div>
      <!-- /.mailbox-read-message -->
    </div>
    <!-- /.card-body -->
    @if($news->attachment)
    <div class="card-footer bg-white">
      <ul class="mailbox-attachments clearfix">
        <li>
          <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> Sep2014-report.pdf</a>
                <span class="mailbox-attachment-size">
                  1,245 KB
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download-alt"></i></a>
                </span>
          </div>
        </li>
        <li>
          <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
                <span class="mailbox-attachment-size">
                  1,245 KB
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                </span>
          </div>
        </li>
 {{--        <li>
          <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo1.png" alt="Attachment"></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo1.png</a>
                <span class="mailbox-attachment-size">
                  2.67 MB
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                </span>
          </div>
        </li>
        <li>
          <span class="mailbox-attachment-icon has-img"><img src="../../dist/img/photo2.png" alt="Attachment"></span>

          <div class="mailbox-attachment-info">
            <a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> photo2.png</a>
                <span class="mailbox-attachment-size">
                  1.9 MB
                  <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                </span>
          </div>
        </li> --}}
      </ul>
    </div>
    @endif
  </div>
  <!-- /. box -->
</div>
<!-- /.col -->

@endsection