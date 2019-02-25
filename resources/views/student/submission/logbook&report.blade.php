@extends('layouts.dash')



@section('content')


	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col">
					<p><i class="fas fa-info-circle text-info pr-1"></i>Steps for uploading Logbook</p>
					<ol>
						<li>Download the IPT-Logbook Document.  Click here </li>
						<li>Use Microsoft office to fill the IPT-Logbook document</li>
						<li>Save the document as Portable Document Format [PDF document]</li>
						<li>Rename the IPT-Logbook.</li>
						<li>Use your Reg NO. Example (201311053_logbook.pdf)</li>
						<li>Finally, Upload it to the system before the <span class="text-danger">deadline</span></li>
					</ol>
				</div>
				
				<div class="col">
					<p><i class="fas fa-info-circle text-info pr-1"></i>Steps for uploading Report</p>
					<ol>
						<li>Write your report In MS office and save as file type{PDF document}</li>
						<li>Rename your report doc using your Admission NO. Example:ADM.NO_report.psdf.</li>
						<li>Use your Reg NO. Example (201311053_logbook.pdf)</li>
						<li>Finally,Upload your IPT Report Document to the system before the <span class="text-danger">deadline</span></li>
					</ol>
				</div>
			</div>
	</div>
	</div>
	

	<div class="justify-content-center">
		<div class="card card-outline card-primary">
			<div class="card-header">
				Arrival Form
			</div>

			<div class="card-body">
			    <form method="POST" action="{{ route('logbook.upload') }}" enctype="multipart/form-data">
			        @csrf 
			        <div class="row">
			        	
			        <div class="form-group row">
			            <label for="logbook" class="col-md-4 col-form-label text-md-right">Logbook</label>

			            <div class="col-md-8">
			                <input type="file" name="logbook" class=" mt-1 {{ $errors->has('logbook') ? ' is-invalid' : '' }}" required>
		                        {{-- <label class="custom-file-label" for="exampleInputFile">Choose logbook file</label> --}}

			                @if ($errors->has('logbook'))
			                    <span class="invalid-feedback" role="alert">
			                        <strong>{{ $errors->first('logbook') }}</strong>
			                    </span>
			                @endif
			            </div>
			        </div>

			        <div class="form-group ml-auto row">
			            <label for="report" class="col-md-4 col-form-label text-md-right">Report</label>

			            <div class="col-md-8">
			                <input type="file" name="report" class=" mt-1 {{ $errors->has('report') ? ' is-invalid' : '' }}" required>
		                        {{-- <label class="custom-file-label" for="exampleInputFile">Choose a report file</label> --}}

			                @if ($errors->has('report'))
			                    <span class="invalid-feedback" role="alert">
			                        <strong>{{ $errors->first('report') }}</strong>
			                    </span>
			                @endif
			            </div>
			        </div>

			        </div>
			        
		            @if(!$log)

			        <div class="form-group">
		                <div class="text-center">
		                    <button type="submit" class="btn btn-primary">
		                        Upload
		                    </button>
		                </div>
		            </div>

		        </form>

		        @else
		            <div class="form-group">
		                <div class="text-center">
		                    <button type="submit" class="btn btn-primary">
		                       <i class="fas fa-edit mr-1"></i>Change upload
		                    </button>
		                </div>
		            </div>

			    </form>

			    <form action="{{ route('logbook.confirm', $log->id) }}" method="post">
			    	@csrf
			    	<!-- Button trigger modal -->
			    	<div class="text-center">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">
						 <i class="fas fa-lock mr-1"></i> Confirm Upload
						</button>
					</div>

					<!-- Modal -->
					<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalCenterTitle">Important</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        You wont be able to change your upload after confirmation is sent.
					        Are you sure this is what you want?
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					        <button type="submit" class="btn btn-primary">Confirm</button>
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