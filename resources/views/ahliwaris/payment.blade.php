@extends('ahliwaris.app')

@section('title', 'Ahliwaris')
@section('dashboard')
<a href="{{route('ahliwaris.index')}}" class="text-white">Dashboard</a>
@endsection
@section('content')
    <div class="col-md-12 mt-5">
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        Detail Jenazah
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Nama <span style="float:right">Diana</span></li>
                            <li class="list-group-item">Identitas KTP <span style="float:right">3210038191839011</span></li>
                            <li class="list-group-item">Agama <span style="float:right">Islam</span></li>
                            <li class="list-group-item">Gender <span style="float:right">Perempuan</span></li>
                            <li class="list-group-item">Tanggal lahir <span style="float:right">12 December 2019</span></li>
                            <li class="list-group-item">Tanggal wafat <span style="float:right">12 December 2020</span></li>
                            {{-- <li class="list-group-item">
                                Alamat
                            <p class="text-right">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum vero minima expedita.</p>
                            </li> --}}
                            <li class="list-group-item">Dokumen <span style="float:right">dokumen_jenazah_xx1.pdf</span></li>
                          </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        Bukti dokumen kematian
                    </div>
                    <div class="card-body">
                        {{-- <div class="alert alert-warning text-center">
                            Menunggu konfirmasi admin
                        </div>
                        <div class="alert alert-danger text-center">
                            Dokumen ditolak, silahkan upload kembali
                        </div> --}}
                        <div class="alert alert-success text-center">
                            Dokumen terverifikasi
                        </div>
                        dokumen_jenazah_xx1.pd
                        
                        {{-- <div class="custom-file">
                            <input type="file" class="custom-file-input" name="docs" id="validatedCustomFile" required>
                            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                        </div> --}}
                    </div>
                    {{-- <div class="card-footer text-right">
                        <button type="submit" class="btn btn-info">Upload</button>
                    </div> --}}
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-info btn-block">Lihat pembayaran</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection