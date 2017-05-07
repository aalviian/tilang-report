@extends('layouts.app')
@section('content')
    <div class= "container">
        <div class= "row">
            <div class= "col-md-12">
                <h3> Daftar Trash Pelanggaran</h3>

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
                                <a href = "{{ url('restore', $posting->id)}}" class = "btn btn-xs btn-success">Restore</a>
                                <a href = "{{ url('forcedelete', $posting->id)}}" class = "btn btn-xs btn-danger">Delete Permanently</a>
                            </td>
                            @empty
                            <td colspan="7">
                                <center>
                                    <h2><i class="fa fa-trash"></i></h2>
                                    <p><h4>Tidak ada data di tong sampah</h4></p>
                                </center>
                            </td>
                            @endforelse
                        </tr>
                    </body>
                </table>
            </div>
        </div>
    </div>
@endsection