@extends('admin.app')

@section('title', 'admin')
@section('dashboard')
<a href="{{route('admin.index')}}" class="text-white">Dashboard</a>
@endsection
@section('content')
    <div class="col-md-12 mt-5">
        <div class="row">
            <div class="offset-md-2 col-md-8">
                <div class="card">
                    <div class="card-body">
                    <div class="h3">
                        Detail Pesanan
                    </div>
                    <p class="h5 font-weight-lighter mt-4 mb-2">Jenazah</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nama <span style="float:right">{{$jenazah->name}}</span></li>
                            <li class="list-group-item">Identitas KTP <span style="float:right">{{$jenazah->identity}}</span></li>
                            <li class="list-group-item">Agama <span style="float:right">{{$jenazah->religion}}</span></li>
                            <li class="list-group-item">Gender <span style="float:right">{{$jenazah->gender}}</span></li>
                            <li class="list-group-item">Tanggal lahir <span style="float:right">{{date('d/m/Y', strtotime($jenazah->birth))}}</span></li>
                            <li class="list-group-item">Tanggal wafat <span style="float:right">{{date('d/m/Y', strtotime($jenazah->death))}}</span></li>
                            <li class="list-group-item">Lokasi makam <span style="float:right">Blok A71</span></li>
                            <li class="list-group-item">Paket <span style="float:right">{{$pkgname}}</span></li>
                            <li class="list-group-item">Dokumen 
                                @if ($doc->status == 0)
                                    <span class="badge badge-warning">Menunggu konfirmasi</span>
                                @elseif($doc->status == 1)
                                    <span class="badge badge-danger">Dokumen ditolak</span>
                                @elseif($doc->status == 2)
                                    <span class="badge badge-success">Verified</span>
                                @endif
                                <span style="float:right">
                                    <a href="{{asset('death_documents/' . $doc->pathname)}}"> {{$doc->pathname}} <a/>
                                </span>
                            </li>
                            <li class="list-group-item">Pembayaran 
                                @php
                                    $payment = App\Payment::find($paymentid);
                                @endphp
                                @if ($payment->status == 0)
                                    <span class="badge badge-warning">Menunggu konfirmasi</span>
                                @elseif($payment->status == 1)
                                    <span class="badge badge-danger">Dokumen ditolak</span>
                                @elseif($payment->status == 2)
                                    <span class="badge badge-success">Lunas</span>
                                    <span style="float:right">
                                        Jam {{ date('H d/m/y ', strtotime($payment->updated_at))}}
                                    </span>
                                @elseif($doc->status == 2 && $payment->status == 3)
                                    <span class="badge badge-info">Dapat melakukan pembayaran</span>
                                @else
                                    <span class="badge badge-default">Belum dapat dilakukan</span>
                                @endif

                            </li>
                            <li class="list-group-item">Alamat
                                <p class="text-right">{{$jenazah->address}}</p>
                            </li>
                          </ul>
                          <a href="{{url()->previous()}}" class="btn btn-info btn-block">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection