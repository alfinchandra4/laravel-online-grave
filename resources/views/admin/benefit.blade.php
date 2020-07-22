@extends('admin.app')

@section('title', 'Admin')
@section('dashboard')
<a href="{{route('admin.index')}}" class="text-white">Dashboard</a>
@endsection
@section('content')
    <div class="offset-md-2 col-md-8 mt-5">
        <div class="card" style="border:0px">
            <div class="card-body p-5"> 
                <div class="d-flex">
                    <div class="h3">
                        <span class="font-weight-light">Paket</span> {{$pkg->name}}
                    </div>
               </div>
                <form method="POST" action="{{route('admin.packagedetail.store', $pkg->id)}}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Tambah benefit" name="value" required/>
                        <div class="input-group-append">
                            <button class="btn btn-outline-success" type="submit">Tambah</button>
                        </div>
                    </div>
                </form>


               @foreach ($details->sortByDesc('created_at') as $benefit)
               <ul class="list-group list-group-flush">
                    <li class="list-group-item">{{$benefit->value}} <span style="float:right"><a href="{{route('admin.packagedetail.remove', $benefit->id)}}">Hapus</a></span></li>
                </ul>                   
               @endforeach

                {{-- Button submit --}}
                <a href="{{route('admin.package')}}" class="btn btn-info btn-block">Kembali</a>
            </div>
        </div>
    </div>
@endsection