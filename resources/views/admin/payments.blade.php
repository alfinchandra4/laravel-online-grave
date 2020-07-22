@extends('admin.app')

@section('title', 'Admin')
@section('content')
@include('admin.profile')
<div class="col-md-9">
    <h3>
        Pembayaran
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div>
                    <h5>
                        <b>Daftar bukti pembayaran</b>
                    </h4>
                </div>
           </div>
           <table class="table table-striped table-bordered table-sm" style="width:100%; font-size:10pt">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Jenazah</th>
                    <th>Paket</th>
                    <th>Harga</th>
                    <th>Pmbryn</th>
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
                                ->join('package', 'package.id', '=', 'trx.package_id')
                                ->join('payment', 'payment.id', '=', 'trx.payment_id')
                                ->orderByDesc('trx.created_at')
                                ->whereNotIn('payment.status', [3])
                                ->select(
                                    'payment.id as payment_id',
                                    'payment.status as payment_status',
                                    'payment.pathname as payment_pathname',
                                    'package.name as pkgname',
                                    'package.price as pkgprice',
                                    'users.name as ahliwaris', 
                                    'jenazah.name as jenazah',
                                    'jenazah.id as jenazah_id', 
                                    'jenazah.birth as lahir', 
                                    'jenazah.death as mati', 
                                    'jenazah_docs.pathname as jenazah_doc_pathname',
                                    'jenazah_docs.id as jenazah_doc_id',
                                    'jenazah_docs.status as jenazah_doc_status')->get();
                @endphp

                @foreach ($data as $d)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$d->jenazah}}</td>
                        <td>{{$d->pkgname}}</td>
                        <td>{{$d->pkgprice}}</td>
                        <td><a href="{{asset('invoice_documents/'.$d->payment_pathname)}}">{{$d->payment_pathname}}<a></td>
                        <td>
                            @if ($d->jenazah_doc_status == 2 && $d->payment_status == 1)
                                -
                            @elseif ($d->jenazah_doc_status == 2 && $d->payment_status == 0)
                                <a href="{{route('admin.payments.reject', $d->jenazah_doc_id)}}" class="btn btn-danger btn-sm" style="font-size: 10pt">Tolak</a>
                                <a href="{{route('admin.payments.accept', $d->jenazah_doc_id)}}" class="btn btn-success btn-sm" style="font-size: 10pt">Terima</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if ($d->jenazah_doc_status == 2 && $d->payment_status == 1)
                                Tertolak
                            @elseif ($d->jenazah_doc_status == 2 && $d->payment_status == 0)
                                Menunggu konfirmasi admin
                            @elseif($d->jenazah_doc_status == 2 && $d->payment_status == 2)
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