@extends('master')

@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Student Details</b></div>
			<div class="col col-md-6">
				<a href="{{ route('students.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
		</div>
	</div>
	<div class="card-body">
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Student Name</b></label>
			<div class="col-sm-10">
				{{ $student->student_name }}
			</div>
		</div>
		<div class="row mb-3">
			<label class="col-sm-2 col-label-form"><b>Student Email</b></label>
			<div class="col-sm-10">
				{{ $student->student_email }}
			</div>
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Student Gender</b></label>
			<div class="col-sm-10">
				{{ $student->student_gender }}
			</div>
		</div>
		<div class="row mb-4">
			<label class="col-sm-2 col-label-form"><b>Student Image</b></label>
			<div class="col-sm-10">
				<img src="{{ asset('images/' .  $student->student_image) }}" width="200" class="img-thumbnail" />
			</div>
		</div>
	</div>
</div>

@endsection('content')
