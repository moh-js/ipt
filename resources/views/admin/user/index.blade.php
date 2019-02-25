@extends('layouts.dash')

@section('content')

<div class="row">
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="fas fa-user-cog"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Admins</span>
        <span class="info-box-number">{{ count($admins) }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="fas fa-user-tie"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Supervisors</span>
        <span class="info-box-number">{{ count($supers) }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-secondary"><i class="fas fa-user-check"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Markers</span>
        <span class="info-box-number">{{ count($markers) }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-danger"><i class="fas fa-user-graduate"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Students</span>
        <span class="info-box-number">{{ count($students) }}</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

<div class="alert alert-info mt-4">
		<i class="icon fas fa-info-circle"></i>
		User can be added according to their Role, click the button of the User role to add users
</div>

{{-- <div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Create new User</h3>
</div>
<div class="card-body">
	<div class="row">
		<div class="col-md-3 col-sm-6 pb-sm-2 pb-xl-2">
			<a href="#" type="button" class="btn btn-block btn-primary btn-flat">Admin</a>
		</div>
		<div class="col-md-3 col-sm-6 pb-sm-2 pb-xl-2">
			<a href="#" type="button" class="btn btn-block btn-success btn-flat">Supervisor</a>
		</div>
		<div class="col-md-3 col-sm-6 pb-sm-2 pb-xl-2">
			<a href="#" type="button" class="btn btn-block btn-info btn-flat">Students</a>
		</div>
		<div class="col-md-3 col-sm-6 pb-sm-2 pb-xl-2">
			<a href="#" type="button" class="btn btn-block btn-warning btn-flat">Markers</a>
		</div>
	</div>
</div>
--}}


	<!-- Custom Tabs -->
    <div class="card card-primary card-outline">
      <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Create Users</h3>
        <ul class="nav nav-pills ml-auto p-2">
          <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Supervisor</a></li>
          <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Marker</a></li>
          <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Students</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1">
           	<div class="row">
           		<div class="col-md-6">
           			<p>Admin should be able to do the following activities</p>
                   	<ol>
                   		<li>Create new Users</li>
                   		<li>Update News</li>
                   		<li>Update Industrial vaccancies</li>
                   		<li>Assign Supervisor</li>
                   	</ol>
           		</div>
           		<div class="col-md-6">
           			<p class="text-danger">Use the excel file only to add new Admin, click the button below to get the sample or create new Admin</p>
           			<p class="lead">Download Admin sample excel file 
                <a href="{{ route('admin.download') }}">here</a> </p>

           			<form action="{{ route('admin.import') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                   @csrf
                   <div class="row">
                       <div class="form-group col-8">
                          <input type="file" name="file" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose admin file</label>
                       </div>
                       <div class="form-group col-4">
                          <input type="submit" value="Add" class="btn btn-primary">  
                       </div>
                    </div>  
                </form>

           		</div>
           	</div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
            <div class="row">
           		<div class="col-md-6">
           			<p>Supervisor should be able to do the following activities</p>
                   	<ol>
                   		<li>Supervise Student</li>
                   		<li>Assign Remarks</li>
                   	</ol>
           		</div>
           		<div class="col-md-6">
           			<p class="text-danger">Use the excel file only to add new Supervisor, click the button below to get the sample or create new Supervisor</p>
           			<p class="lead">Download Superviosr sample excel file 
                <a href="{{ route('supervisor.download') }}">here</a> </p>


                  <form action="{{ route('supervisor.import') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                   @csrf
                   <div class="row">
                       <div class="form-group col-8">
                          <input type="file" name="file" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose supervisor file</label>
                       </div>
                       <div class="form-group col-4">
                          <input type="submit" value="Add" class="btn btn-primary">  
                       </div>
                    </div>  
                  </form>
                  

           		</div>
           	</div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_3">
            <div class="row">
           		<div class="col-md-6">
           			<p>Marker should be able to do the following activities</p>
                   	<ol>
                   		<li>Marks Logbooks and reports</li>
                   		<li>Update Marks</li>
                   	</ol>
           		</div>
           		<div class="col-md-6">
           			<p class="text-danger">Use the excel file only to add new markers, click the button below to get the sample or create new Markers</p>
                <p class="lead">Download Marker sample excel file 
           			<a href="{{ route('marker.download') }}">here</a> </p>

           			<form action="{{ route('marker.import') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                   @csrf
                   <div class="row">
                       <div class="form-group col-8">
                          <input type="file" name="file" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose marker file</label>
                       </div>
                       <div class="form-group col-4">
                          <input type="submit" value="Add" class="btn btn-primary">  
                       </div>
                    </div>  
                </form>
           		</div>
           	</div>
         </div>

          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_4">
            <div class="row">
           		<div class="col-md-6">
           			<p>Students should be able to do the following activities</p>
                   	<ol>
                   		<li>Send Arrival form</li>
                      <li>Submit Logbook & Report</li>
                   		<li>View News</li>
                   	</ol>
           		</div>
           		<div class="col-md-6">
           			<p class="text-danger">Use the excel file only to add new Students, click the button below to get the sample or create new Students</p>
           			<p class="lead">Download student sample excel file 
                <a href="{{ route('student.download') }}">here</a> </p>

           			<form action="{{ route('student.import') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                   @csrf
                   <div class="row">
                       <div class="form-group col-8">
                        <input type="file" name="file" class="custom-file-input">
                        <label class="custom-file-label" for="exampleInputFile">Choose student file</label>
                       </div>
                       <div class="form-group col-4">
                          <input type="submit" value="Add" class="btn btn-primary">  
                       </div>
                    </div>  
                </form>
           		</div>
           	</div>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div><!-- /.card-body -->
    </div>
    <!-- ./card -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<!-- END CUSTOM TABS -->

@endsection