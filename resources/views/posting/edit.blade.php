@extends('layouts.app')
	@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Edit Pelanggaran {{ $posting->plat_nomor }}</h3>

					{!! Form::model($posting, ['route'=> ['postings.update', $posting], 'method'=>'patch', 'files'=>true]) !!}

						@include('posting.form', ['model'=>$posting])

					{!! Form::close() !!} 
				</div>
			</div>
		</div>
	@endsection