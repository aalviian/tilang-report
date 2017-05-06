@extends('layouts.app')
	@section('content')
		<div class= "container">
			<div class= "row">
				<div class= "col-md-6">
					<h3>Catat Pelanggaran</h3>
					{!! Form::open(['route' => 'postings.store', 'files'=>true]) !!}
						@include('posting.form')
					{!! Form::close() !!}
				</div>
			</div> 
		</div> 
	@endsection