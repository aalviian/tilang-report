@extends('layouts.app')
@section('content')
    <div class= "container">
        <div class= "row">
            <div class= "col-md-12">
                <h3> Daftar Pelanggaran  <a href= "{{ route('postings.create') }}" class= "btn btn-danger btn-sm" >+</a></h3>
                <div class= "col-md-4">
                    {!! Form::open(['url' => 'postings', 'method'=>'get', 'class'=>'form-inline']) !!}

                        <div class="form-group {!! $errors->has('query') ? 'has-error' : '' !!}">
                        {!! Form::text('query', isset($query) ? $query : null, ['class'=>'form-control','placeholder' => 'Searching...']) !!}
                        {!! $errors->first('query', '<p class="help-block">:message</p>') !!}
                        </div>

                        {!! Form::submit('Search', ['class'=>'btn btn-primary']) !!}

                    {!! Form::close() !!}
                 </div>

                <table class= "table table-hover">
                    <thead>
                        <tr>
                            <td>Pelanggaran</td>
                            <td>Jenis Kendaraan</td>
                            <td>Plat Nomor</td>
                            <td>Gambar</td>
                            <td>Created at</td>
                            <td>Updated at</td>
                            <td>Action</td>
                        </tr> 
                    </thead>
                    <tbody>
                        @forelse( $postings as $posting)
                        <tr>
                            <td>{{ $posting -> pelanggaran }} </td>
                            <td>{{ $posting -> jenis_kendaraan }}</td>
                            <td>{{ $posting -> plat_nomor }}</td>
                            <td>
                                <img src="{{ url('/img/',$posting->lastImage) }}" width="50" height="50" alt="..."  class="img-responsive">
                            </td>
                            <td>{{ $posting -> created_at }}</td>
                            <td>{{ $posting -> updated_at }}</td>
                            <td>
                                <a href = "{{ route('postings.edit', $posting->id)}}" class = "btn btn-xs btn-success">Edit</a> |
                                {!! Form::model($posting, ['route' => ['postings.destroy', $posting], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
                                {!! Form::submit('delete', ['class'=>'btn btn-xs btn-danger js-submit-confirm']) !!}
                                {!! Form::close() !!}
                            </td>
                            @empty
                            <td colspan="7">
                                <center>
                                    <h2>:(</h2>
                                    <p><h4>Ops, pencarian tidak ditemukan</h4></p>
                                </center>
                            </td>
                            @endforelse
                        </tr>
                    </body>
                </table>
                {{ $postings->links() }}
            </div>
        </div>
    </div>
@endsection