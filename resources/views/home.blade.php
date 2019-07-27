@extends('layouts.dash')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('/public/css/custom.css') }}">

@endsection

@section('content')

<!-- Main content -->

  {{-- admin section --}}
  @role('admin')
    <div class="row col-md-12">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ count($adminIndustry) }}</h3>

            <p>Industries</p>
          </div>
          <div class="icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $logbook }}</h3>

            <p>Submission</p>
          </div>
          <div class="icon">
            <i class="fas fa-cloud-upload-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>0</h3>

            <p>Supervision</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-check"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ count($arrival) }}</h3>

            <p>Arrival</p>
          </div>
          <div class="icon">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <a href="{{ route('info.arrival') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    
    {{-- endAdmin section --}} 
    @endrole

    {{-- Student section --}}
    @role('student')

      <div class="row col-md-12">
        <div class="col-md-8">
          <div class="row">
            <div class="col-sm-6 col-12">
              <div class="info-box bg-info">
                <span class="info-box-icon"><i class="fas fa-map-marker-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Industries</span>
                  <span class="info-box-number">{{ count($placements) }}</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: {{ $percentage }}%"></div>
                  </div>
                  <span class="progress-description">
                   {{$vac}} Vacancy available
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-sm-6 col-12">
              <div class="info-box bg-success" {{-- style="background-color: #0076cc; color: white; --}}">
                <span class="info-box-icon"><i class="fas fa-cloud-upload-alt"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Submission</span>
                  <span class="info-box-number">0</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: 70%"></div>
                  </div>
                  <span class="progress-description">
                    blank
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          
          <div class="card card-outline card-primary">
            <div class="card-header">IPT Regulation</div>
            <div class="card-body">
              <ol type="1">
                <li>Industrial Practical Training assessment shall count towards the final GPA. </li>
                <li>A student who has been unable to complete the Industrial Practical Training for valid reasons, shall be assigned an “I” grade and shall be required to complete the training within a period specified by University. </li>
                <li>A student shall attend IPT for the specified duration set by the University </li>
                <li>A student who could not complete the Industrial Practical Training for no genuine reasons shall be considered to have absconded and shall be discontinued from studies. </li>
                <li>A student who, for some genuine reasons changes the allocated placement shall notify the Industrial Liaison Office (ILO) in writing within seven working days after reporting to the new location. Failure to report shall be considered to have absconded from studies.</li> 
                <li>Industrial Practical Training reports shall be submitted to the Industrial Liaison Officer within two weeks after completion of the IPT. </li>
                <li>A student who, for no genuine reasons, fails to submit the logbook within a prescribed period of time shall be awarded a zero mark. </li>
                <li>Any student who misses any part or assessment of any portion of the IPT shall be  awarded a zero mark for the missing part or portion.</li>
                <li>A student who fails in the IPT will be required to re-do the training at his/her own expense and within a period specified by the University.</li> 
              </ol>
            </div>
          </div>

        </div>

        <div class="col-md-4">
          <div class="card card-info card-outline">
            <div class="card-header">
              <h3 class="card-title">
                News
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
              <div class="news">
                <ul class="list-unstyled">
                  @foreach($infos as $info)
                  <li>
                    <div class="">
                      <h5 class="text-center">{{ $info->title }}</h5>
                    </div>
                    <div class="">
                      {!! $info->description !!}
                    </div>
                    <div class="">
                      <p class="text-danger">Download the Attachment <a href="" title="">Here</a></p>
                    </div>
                  </li>
                  <hr class="jumbotron-hr">
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
         </div>
      
      </div>
    @endrole
    {{-- end student section --}}

    {{-- Supervisor section --}}
    @role('supervisor')
    <div class="row  col-md-12">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ count($students) }}</h3>

            <p>Students</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-graduate"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ count($supervised) }}</h3>

            <p>Supervised</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-check"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>0</h3>

            <p>Days</p>
          </div>
          <div class="icon">
            <i class="far fa-calendar-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>0</h3>

            <p>Arrival</p>
          </div>
          <div class="icon">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->


    <div class="card card-outline card-primary  col-md-11">
      <div class="card-header">Activities</div>
      <div class="card-body">
        <ol>
          <li>View assigned student</li>
          <li>Assign assessment mark to a specific student</li>
          <li>Provide comment for a particular student ability and field performance</li>
          <li>View time left of supervision</li>
        </ol>
      </div>
    </div>

    @endrole
    {{-- End supervisor section --}}


    {{-- Markers section --}}
    @role('marker')
    <div class="row  col-md-12">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $users }}</h3>

            <p>Students</p>
          </div>
          <div class="icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $logbook_mark }}</h3>

            <p>Marked</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-check"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $dep_logbook }}</h3>

            <p>Submission</p>
          </div>
          <div class="icon">
            <i class="fas fa-cloud-upload-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ count($supervised) }}</h3>

            <p>Supervised</p>
          </div>
          <div class="icon">
            <i class="fas fa-map-marked-alt"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="card card-outline card-primary  col-md-11">
      <div class="card-header">Activities</div>
      <div class="card-body">
        <ol>
          <li>Marks Logbooks and reports</li>
          <li>Export Marks</li>
        </ol>
      </div>
    </div>

    @endrole
    {{-- End marker section --}}

@endsection

<!-- page script -->
@section('script')

<script src="{{ asset('/public/js/jQuery.scrollText.js') }}"></script>
<script>
 
     $(function(){
 
        $(".news").scrollText({
 
          'duration': 2000
 
   });
 
})
</script>

@endsection