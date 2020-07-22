@extends('ahliwaris.app')

@section('title', 'Ahliwaris')
@section('dashboard')
    <a href="{{route('ahliwaris.index')}}" class="text-white">Dashboard</a>
@endsection
@section('css')
    <style>
        .empty_seat {
            border:1px solid black; 
            border-radius:4px; 
            font-size:10pt; 
            text-align:center; 
            background-color: #42b883;
        }
        .full_seat {
            border:1px solid black; 
            border-radius:4px; 
            font-size:10pt; 
            text-align:center; 
            background: red;
        }
        .empty_seat, .full_seat {
            color: white;
        }
    </style>
@endsection
@section('content')
    <div class="offset-md-2 col-md-8 mt-5">
        <div class="card" style="border:0px">
            <div class="card-body p-5"> 
                <div class="h3">
                    Tambah Pesanan
                </div>

                {{-- Jenazah --}}
                <form method="POST" action="{{route('ahliwaris.store')}}" enctype="multipart/form-data" accept="application/pdf" id="createFrm">
                    @csrf
                    <p class="h5 font-weight-lighter mt-4 mb-2">Jenazah</p>
                    <div class="form-group">
                        <label for="package" class="text-muted">Paket</label>
                        @php
                            $packages = App\Package::all();
                        @endphp
                        <select name="package" id="package" class="form-control">
                            @foreach ($packages as $pkg)
                                <option value="{{$pkg->id}}">{{$pkg->name}} - Rp.{{number_format($pkg->price)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name" class="text-muted">Nama</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="identity" class="text-muted">Identitas KTP</label>
                        <input type="text" name="identity" id="identity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="religion" class="text-muted">Agama</label>
                        <select name="religion" id="religion" class="form-control">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gender" class="text-muted">Jenis kelamin</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birth" class="text-muted">Tanggal lahir</label>
                        <input type="date" name="birth" id="birth" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="death" class="text-muted">Tanggal wafat</label>
                        <input type="date" name="death" id="death" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="text-muted">Alamat</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-muted">Upload surat kematian</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="doc" id="doc" required>
                            <label class="custom-file-label outputFile" id="outputFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <div class="row mr-1">
                                @php
                                    $sectorA = App\Sector::where('sector_code', 'A')->get();
                                    $sectorB = App\Sector::where('sector_code', 'B')->get();
                                    $sectorC = App\Sector::where('sector_code', 'C')->get();
                                    $sector  = App\Sector::select('sector_code')->distinct()->get();
                                @endphp
                                @foreach ($sectorA as $A)
                                    @if ($A->trx_id == null ) 
                                        <div class="col-md-3 empty_seat">
                                            <span>{{$A->seat}}</span>
                                        </div>
                                    @else
                                        <div class="col-md-3 full_seat">
                                            <span>{{$A->seat}}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="row">   
                                @foreach ($sectorB as $B)
                                    @if ($B->trx_id == null ) 
                                        <div class="col-md-3 empty_seat">
                                            <span>{{$B->seat}}</span>
                                        </div>
                                    @else
                                        <div class="col-md-3 full_seat">
                                            <span>{{$B->seat}}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md">
                            <div class="row">
                                @foreach ($sectorC as $C)
                                    @if ($C->trx_id == null ) 
                                        <div class="col-md-1 empty_seat">
                                            <span>{{$C->seat}}</span>
                                        </div>
                                    @else
                                        <div class="col-md-1 full_seat">
                                            <span>{{$C->seat}}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <label for="" class="text-muted">Pilih makam:</label>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="sector">Blok</label>
                            <select name="sector" id="sector" class="form-control">
                                <option>Pilih blok</option>
                                @foreach ($sector as $code)
                                    <option value="{{$code->sector_code}}">{{$code->sector_code}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="seat">Nomor</label>
                                <select name="seat" id="seat" class="form-control"></select>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Button submit --}}
                <button type="submit" class="btn btn-info btn-block" form="createFrm">Tambah pesanan</button>
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

    <script>
        $(document).ready(function() {
            $("#sector").change(function() {
                $("#seat").empty();
                sector_code = $(this).val();
                console.log(sector_code);
                $.ajax({
                    type: 'GET',
                    url: '/getseat/' + sector_code,
                    dataType: 'JSON',
                    success: function(data) {
                        jQuery.each(data, function(index, val) {
                            //now you can access properties using dot notation
                            // console.log(val.seat);
                            $("#seat").append($('<option>', {
                                value:val.seat, text:val.seat}
                            ))
                        });
                    }
                });
            });
        });
    </script>
@endsection

                {{-- Pemesan --}}
                {{-- <p class="h5 font-weight-lighter mt-4 mb-2">Pemesan</p>
                <div class="form-group">
                  <label for="name" class="text-muted">Nama</label>
                  <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group" class="form-control">
                    <label for="ttlp" class="text-muted">Tanggal lahir</label>
                    <input type="date" name="ttlp" id="ttlp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="addressp" class="text-muted">Alamat</label>
                    <input type="text" name="addressp" id="addressp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="telp" class="text-muted">Telepon</label>
                    <input type="tel" name="telp" id="telp" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email" class="text-muted">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="hub" class="text-muted">Hubungan</label>
                    <input type="text" name="hub" id="hub" class="form-control" required>
                </div> --}}
                {{-- End Pemesan --}}