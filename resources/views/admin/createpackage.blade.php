@extends('admin.app')

@section('title', 'Admin')
@section('dashboard')
<a href="{{route('admin.index')}}" class="text-white">Dashboard</a>
@endsection
@section('content')
    <div class="offset-md-2 col-md-8 mt-5">
        <div class="card" style="border:0px">
            <div class="card-body p-5"> 
                <div class="h3">
                    Tambah Paket
                </div>
                <form method="POST" action="{{route('admin.package.store')}}" id="createPkgFrm">
                    @csrf
                    <div class="form-group">
                        <label for="package_code">Kode paket</label>
                        <input type="text" name="package_code" id="package_code" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Paket</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="text" name="price" id="price" class="form-control" required>
                    </div>
                </form>

                {{-- Button submit --}}
                
                <div class="text-right">
                    <a href="{{route('admin.package')}}" type="submit" class="btn btn-light">Kembali</a>
                    <button type="submit" class="btn btn-success" form="createPkgFrm">Tambah</button>
                </div>
            </div>
        </div>
    </div>
@endsection