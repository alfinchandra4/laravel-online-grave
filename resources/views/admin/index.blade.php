@extends('admin.app')

@section('title', 'Admin')
@section('content')
@include('admin.profile')
<div class="col-md-9">
    <h3>
        Semua Transaksi
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
           </div>
           @php
            $data = DB::table('trx')
                ->join('users', 'users.id', '=', 'trx.user_id')
                ->join('jenazah', 'jenazah.id', '=', 'trx.jenazah_id')
                ->join('jenazah_docs', 'jenazah_docs.jenazah_id', '=', 'jenazah.id')
                ->join('package', 'package.id', '=', 'trx.package_id')
                ->join('payment', 'payment.id', '=', 'trx.payment_id')
                ->orderByDesc('trx.created_at')
                ->select(
                    'payment.id as payment_id',
                    'payment.status as payment_status',
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
            <table id="example" class="table table-striped table-bordered example table-sm" style="width:100%" style="font-size:10pt">
                <thead>
                    <tr style="font-size:10pt">
                        <th>No</th>
                        <th>Ahliwaris</th>
                        <th>Jenazah</th>
                        <th>Wafat</th>
                        <th>Doc</th>
                        <th>Pmbyrn</th>
                        <th>detail</th>
                    </tr>
                </thead>
                <tbody style="font-size:10pt">
                    @foreach ($data as $trx)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$trx->ahliwaris}}</td>
                            <td>{{$trx->jenazah}}</td>
                            <td>{{$trx->mati}}</td>
                            <td>
                                @if ($trx->jenazah_doc_status == 0)
                                    <span class="badge badge-warning">Menunggu konfirmasi</span>
                                @elseif($trx->jenazah_doc_status == 1)
                                    <span class="badge badge-danger">Dokumen ditolak</span>
                                @elseif($trx->jenazah_doc_status == 2)
                                    <span class="badge badge-success">Verified</span>
                                @endif
                            </td>
                            <td>
                                @if ($trx->payment_status == 0)
                                    <span class="badge badge-warning">Menunggu konfirmasi</span>
                                @elseif($trx->payment_status == 1)
                                    <span class="badge badge-danger">Dokumen ditolak</span>
                                @elseif($trx->payment_status == 2)
                                    <span class="badge badge-success">Lunas</span>
                                @elseif($trx->jenazah_doc_status == 2 && $trx->payment_status == 3)
                                    <span class="badge badge-info">Dapat melakukan pembayaran</span>
                                @else
                                    <span class="badge badge-info">Belum dapat dilakukan</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.jenazah.detail', $trx->jenazah_id)}}">Lihat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
          $('#example').DataTable();
      });
    </script>
@endsection