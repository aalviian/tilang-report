<div class= "form-group { !! $errors->has('pelanggaran') ? 'has-error' : '' !!}">
{!! Form::label('pelanggaran' , 'Deskripsi Pelanggaran') !!} 
{!! Form::text('pelanggaran', null, ['class' =>'form-control']) !!}
{!! $errors->first('pelanggaran', '<p class="help-block">:message</p>') !!}
</div>

<div class= "form-group { !! $errors->has('jenis_kendaraan') ? 'has-error' : '' !!}">
{!! Form::label('jenis_kendaraan' , 'Jenis Kendaraan') !!}
{!! Form::text('jenis_kendaraan', null, ['class' =>'form-control']) !!}
{!! $errors->first('jenis_kendaraan', '<p class="help-block">:message</p>') !!}
</div>

<div class= "form-group { !! $errors->has('plat_nomor') ? 'has-error' : '' !!}">
{!! Form::label('plat_nomor' , 'Plat Nomor') !!}
{!! Form::text('plat_nomor', null, ['class' =>'form-control']) !!}
{!! $errors->first('plat_nomor', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group {!! $errors->has('lastImage') ? 'has-error' : '' !!}">
{!! Form::label('latImage', 'Gambar Penunjang ( jpg,jpeg,png )') !!}
{!! Form::file('lastImage') !!}
{!! $errors->first('lastImage', '<p class="help-block">:message</p>')  !!}

	@if (isset($model) && $model->lastImage !== '' )
	<div class= "row">
		<div class= "col-md-6">
			<p>Current photo:</p>
			<div class= "thumbnail">
				<img src = "{{ url('/img/' . $model->lastImage) }}" class="img-rounded">
			</div>
		</div>
	</div>
	@endif
	@if (isset($model) && $model->lastImage == '')
	<div class= "row">
		<div class= "col-md-6">
			<p>Current photo:</p>
			<div class= "thumbnail">
				<img src = "{{ url('/img/notfound.png') }}" class="img-rounded">
			</div>
		</div>
	</div>
	@endif
</div>

<a href = "{{ route('postings.index') }}" class = "btn btn-danger">Cancel</a>

{!! Form::submit( isset( $model) ? 'Update' : 'Save', [ 'class'=> 'btn btn-primary']) !!}
<br>
<br>