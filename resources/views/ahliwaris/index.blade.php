@extends('ahliwaris.app')

@section('title', 'Ahliwaris')
@section('content')
@include('ahliwaris.profile')
<div class="col-md-9">
    <h3>
        Dashboard
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div>
                    <h4>
                        <b>Transaksi</b>
                    </h4>
                </div>
                <div class="ml-auto">
                   <a href="{{route('ahliwaris.create')}}" class="btn btn-primary btn-sm">
                        Tambah Pesanan
                   </a>
                </div>
           </div>
           @php
            $data = DB::table('trx')
                        ->join('users', 'users.id', '=', 'trx.user_id')
                        ->join('jenazah', 'jenazah.id', '=', 'trx.jenazah_id')
                        ->join('jenazah_docs', 'jenazah_docs.jenazah_id', '=', 'jenazah.id')
                        ->join('package', 'package.id', '=', 'trx.package_id')
                        ->leftJoin('payment', 'payment.id', '=', 'trx.payment_id')
                        ->orderByDesc('trx.created_at')
                        ->where('users.id', auth()->guard('user')->user()->id)
                        ->select(
                            'trx.created_at as order_date',
                            'package.name as pkg',
                            'package.price as price',
                            'users.name as ahliwaris',
                            'jenazah.name as jenazah',
                            'jenazah.id as jenazahid',
                            'jenazah_docs.status as doc_status',
                            'payment.status as pay_status',
                            'payment.id as payment_id')->get();
            @endphp
            @foreach ($data as $trx)
            <div class="card mb-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="background: #f8f8f8">
                        <div class="row">
                            <div class="col-md-3">
                              <span class="text-muted" style="font-size:11pt">Pesanan</span>
                              <p>{{date('d/m/Y', strtotime($trx->order_date))}}</p>
                            </div>
                            <div class="col-md-3">
                              <span class="text-muted" style="font-size:11pt">Paket</span>
                               <p>{{$trx->pkg}}</p>
                            </div>
                            <div class="col-md-2">
                              <span class="text-muted" style="font-size:11pt">Total tagihan</span>
                              <p>Rp. {{number_format($trx->price)}}</p>
                            </div>
                            <div class="col-md-4 text-right">
                                <p></p>
                                <a href="{{route('ahliwaris.detail', $trx->jenazahid)}}" class="btn btn-outline-success btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-3">
                              <span class="text-muted" style="font-size:11pt">Pemesan</span>
                              <p>{{auth()->guard('user')->user()->name}}</p>
                            </div>
                            <div class="col-md-3">
                              <span class="text-muted" style="font-size:11pt">Jenazah</span>
                               <p>{{$trx->jenazah}}</p>
                            </div>
                            <div class="col">
                               <span class="text-muted" style="font-size:11pt">Status</span>
                               <p>
                                   <i>
                                    @if ($trx->doc_status == 0)
                                        <span>Menunggu konfirmasi admin</span>
                                    @elseif ($trx->doc_status == 1)
                                        <span>Dokumen ditolak, silahkan upload kembali dokumen</span>
                                    @elseif($trx->doc_status == 2 && $trx->pay_status == 3)
                                        <span>
                                            Dokumen diterima, silahkan melakukan pembayaran 
                                            <a href="{{route('ahliwaris.detail', $trx->jenazahid)}}">Disini</a>
                                        </span>
                                    @elseif($trx->doc_status == 2 && $trx->pay_status == 0)
                                        <span>Pembayaran menunggu konfirmasi admin</span>
                                    @elseif($trx->doc_status == 2 && $trx->pay_status == 1)
                                        <span>
                                            Bukti pembayaran ditolak, silahkan upload kembali bukti pembayaran
                                            <a href="{{route('ahliwaris.detail', $trx->jenazahid)}}">Disini</a>
                                        </span>
                                    @else
                                        <span>
                                            Pembayaran diterima, silahkan lihat jadwal pemakaman
                                            <a href="{{route('ahliwaris.detail', $trx->jenazahid)}}">Disini</a>
                                        </span>
                                    @endif
                                   </i>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>     
            @endforeach


        </div>
    </div>
</div>
@endsection