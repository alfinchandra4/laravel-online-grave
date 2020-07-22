@extends('admin.app')

@section('title', 'Admin')
@section('content')
@include('admin.profile')
<div class="col-md-9">
    <h3>
        Paket
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div>
                    <h5>
                        <b>Daftar paket</b>
                    </h5>
                </div>
                <div class="ml-auto">
                    <a href="{{route('admin.package.create')}}" class="btn btn-primary btn-sm">
                            Tambah paket
                    </a>
                </div>
           </div>
           <table  class="table table-striped table-bordered table-sm" style="width:100%; font-size:10pt">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Paket</th>
                    <th>Benefit</th>
                    <th>Harga</th>
                    <th>Status</th>
                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>
                @php
                    $packages = App\Package::all();
                @endphp
                @foreach ($packages as $pkg)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$pkg->package_code}}</td>
                        <td>{{$pkg->name}}</td>
                        <td><a href="{{route('admin.package.benefit', $pkg->id)}}">Lihat</a></td>
                        <td>{{$pkg->price}}</td>
                        <td>
                            @if ($pkg->active == 0)
                                <a href="{{route('admin.package.enable', $pkg->id)}}">Enable</a> 
                            @else
                                <a href="{{route('admin.package.disable', $pkg->id)}}">Disable</a>
                            @endif
                        </td>
                        {{-- <td>
                            <a href="{{route('admin.package.remove', $pkg->id)}}">Hapus</a>
                        </td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection