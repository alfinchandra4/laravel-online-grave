@extends('ahliwaris.app')

@section('title', 'Ahliwaris')

@section('dashboard') <a href="{{route('ahliwaris.index')}}" class="text-white">Dashboard</a> @endsection

@section('content')

    @php $payment = App\Payment::find($paymentid); @endphp
    <div class="col-md-12 mt-5">
            {{-- @if($payment->status == 2)
                <div class="alert alert-primary" role="alert">
                    @php $dikubur = date('H:i A', strtotime('+3 hour', strtotime($payment->created_at))); @endphp
                    <b>Catatan:</b>  Silahkan datang ke makam pada pukul {{ $dikubur }} & menghubungi bagian admin makam, terimakasih
                </div>
            @endif --}}
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Detail Jenazah
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nama <span style="float:right">{{$jenazah->name}}</span></li>
                            <li class="list-group-item">Identitas KTP <span style="float:right">{{$jenazah->identity}}</span></li>
                            <li class="list-group-item">Agama <span style="float:right">{{$jenazah->religion}}</span></li>
                            <li class="list-group-item">Gender <span style="float:right">{{$jenazah->gender}}</span></li>
                            <li class="list-group-item">Tanggal lahir <span style="float:right">{{date('d/m/Y', strtotime($jenazah->birth))}}</span></li>
                            <li class="list-group-item">Tanggal wafat <span style="float:right">{{date('d/m/Y', strtotime($jenazah->death))}}</span></li>
                            <li class="list-group-item">Lokasi makam <span style="float:right">{{ $seat }}</span></li>
                            <li class="list-group-item">Paket <span style="float:right">{{$pkgname}}</span></li>
                            <li class="list-group-item">Dokumen 
                                @if ($doc->status == 0)
                                    <span class="badge badge-warning">Menunggu konfirmasi admin</span>
                                @elseif ($doc->status == 1)
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-success">Diterima</span>
                                @endif
                                <span style="float:right">
                                    @if (! $doc->pathname)
                                        <a href="#" data-toggle="modal" data-target="#exampleModal">
                                            Upload ulang
                                        </a>
                                        <!-- Modal upload payment-->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload dokumen</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('ahliwaris.reupload', $jenazah->id)}}" enctype="multipart/form-data" id="reupload">
                                                        @csrf
                                                        <div class="custom-file">
                                                            <input type="file" id="doc" class="custom-file-input" name="doc" accept="application/pdf" required>
                                                            <label class="custom-file-label outputFile" id="outputFile">Choose file</label>                        
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" form="reupload">Save changes</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    @else
                                        <a href="{{$doc->pathname}}">{{$doc->pathname}}</a>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item">Alamat
                                <p class="text-right">{{$jenazah->address}}</p>
                            </li>
                          </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pembayaran</h4>
                        <p class="card-text">
                            <ul class="list-group">
                                <li class="list-group-item">BNI: 1231121212</li>
                                <li class="list-group-item">BCA: 128019999101022</li>
                                <li class="list-group-item">Mandiri: 908192988</li>
                            </ul>
                        </p>
                        @if($payment->status !== 3 && $doc->status == 2)
                            @if ($payment->status == 0 && $doc->status == 2)
                            <div class="alert alert-warning" role="alert">
                                Menunggu konfirmasi admin <br/>
                            </div>
                            <a href="{{asset('invoice_documents/'.$payment->pathname)}}">{{$payment->pathname}}</a>
                            @elseif($payment->status == 1)
                            <div class="alert alert-danger" role="alert">
                                Pembayaran ditolak
                            </div>
                                <a href="#" data-toggle="modal" data-target="#modalPayment">Upload ulang pembayaran</a>
                            @elseif($payment->status == 2)
                            <div class="alert alert-success" role="alert">
                                Pembayaran diterima
                            </div>
                            <a href="{{route('ahliwaris.check.schedule', $jenazah->id)}}" class="btn btn-outline-info btn-block btn-sm">
                                Kirim jadwal
                            </a>
                            @else
                                <a href="#" data-toggle="modal" data-target="#modalPayment">Lakukan pembayaran</a>
                            @endif
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="modalPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form pembayaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{route('ahliwaris.payment.store', $trxid)}}" enctype="multipart/form-data" id="paymentFrm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="sender">Pemilik rekening</label>
                                        <input type="text" name="sender" id="sender" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        @php
                                            $bank = ['BNI', 'BRI', 'BCA', 'Mandiri'];
                                        @endphp
                                        <label for="from_bank">Dari Bank</label>
                                        <select name="from_bank" class="form-control form-control-sm" required>
                                            @foreach ($bank as $b)
                                                <option value="{{$b}}">{{$b}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="acc_number">Nomor Rekening</label>
                                        <input type="text" name="acc_number" id="acc_number" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="to_bank">Ke Bank</label>
                                        <select name="to_bank" class="form-control form-control-sm" required>
                                            @foreach ($bank as $b)
                                                <option value="{{$b}}">{{$b}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Jumlah</label>
                                        <input type="text" name="amount" id="amount" class="form-control form-control-sm" required>
                                    </div>
            
                                    <label>Upload bukti pembayaran</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="doc" name="doc" aria-describedby="inputGroupFileAddon01" required>
                                          <label class="custom-file-label outputFile" for="doc">Choose file</label>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" form="paymentFrm">Save changes</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $("#doc").change(function() {
      filename = this.files[0].name
      console.log(filename);
      $(".outputFile").text(filename);
    });
  </script>
  
@endsection