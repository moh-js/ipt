@extends('layouts.dash')


@section('content')

<div class="row">
        <div class="col-md-3">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <li class="nav-item active">
                  <a href="#" class="nav-link">
                    <i class="fa fa-inbox"></i> Inbox
                    <span class="badge bg-primary float-right">{{ count($news) }}</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="fas fa-trash"></i> Trash
                  </a>
                </li>
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">News</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm">
                  <input type="text" class="form-control" placeholder="Search Mail">
                  <div class="input-group-append">
                    <div class="btn btn-primary">
                      <i class="fa fa-search"></i>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                  @foreach($news as $news)
                  @php $new =  Carbon\Carbon::parse($news->created_at)->diffInDays(null, true) @endphp
                    <tr>

                      @if($new < 30)
                      <td>
                        <img src=" {{ asset('img/New.png') }} " class="img-fluid" alt="">
                      </td>
                      @endif
                      <td class="mailbox-name"><a href="{{ route('news.read', $news->id) }}">{{ $news->title }}</a></td>
                      <td class="mailbox-subject">
                        {!! str_limit($news->description, 60) !!}
                      </td>
                      @if($news->attachment)
                        <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                      @endif
                      <td class="mailbox-date">{{ Carbon\Carbon::parse($news->created_at)->diffForHumans(null, true) }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
{{--             <div class="card-footer p-0">
              <div class="mailbox-controls">

              </div>
            </div> --}}
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection