@extends('admin.app')

@section('title', 'Admin')
@section('content')
@include('admin.profile')
<div class="col-md-9">
    <h3>
        Dokumen jenazah
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div>
                    <h5>
                        <b>Daftar dokumen</b>
                    </h4>
                </div>
           </div>
           <table  class="table table-striped table-bordered table-sm" style="width:100%; font-size:10pt">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ahliwaris</th>
                    <th>Jenazah</th>
                    <th>Dokumen</th>
                    <th>Opsi</th>
                    <th>Ket</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $data = DB::table('trx')
                                ->join('users', 'users.id', '=', 'trx.user_id')
                                ->join('jenazah', 'jenazah.id', '=', 'trx.jenazah_id')
                                ->join('jenazah_docs', 'jenazah_docs.jenazah_id', '=', 'jenazah.id')
                                ->orderByDesc('trx.created_at')
                                ->select(
                                    'users.name as ahliwaris', 
                                    'jenazah.name as jenazah', 
                                    'jenazah.birth as lahir', 
                                    'jenazah.death as mati', 
                                    'jenazah.id as jenazah_id',
                                    'jenazah_docs.pathname as jenazah_doc',
                                    'jenazah_docs.id as jenazah_doc_id',
                                    'jenazah_docs.status as status_doc')
                                ->get();
                @endphp

                @foreach ($data as $d)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$d->ahliwaris}}</td>
                        <td>{{$d->jenazah}}</td>
                        {{-- <td>{{date('d/m/Y', strtotime($d->lahir))}}</td>
                        <td>{{date('d/m/Y', strtotime($d->mati))}}</td> --}}
                        <td><a href="{{asset('death_documents/'.$d->jenazah_doc)}}">{{$d->jenazah_doc}}<a></td>
                        <td>
                            @if ($d->jenazah_doc == null && $d->status_doc == 1)
                                -
                            @elseif ($d->status_doc == 0)
                                <a href="{{route('admin.documents.reject', $d->jenazah_doc_id)}}" class="btn btn-danger btn-sm">Tolak</a>
                                <a href="{{route('admin.documents.accept', $d->jenazah_doc_id)}}" class="btn btn-success btn-sm">Terima</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($d->jenazah_doc == null && $d->status_doc == 1)
                                Tertolak
                            @elseif ($d->status_doc == 0)
                                Menunggu konfirmasi admin
                            @else
                                Diterima
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.jenazah.detail', $d->jenazah_id)}}">Lihat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection