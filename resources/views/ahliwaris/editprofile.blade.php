@extends('ahliwaris.app')

@section('title', 'Home - Admin')
@section('dashboard')
<a href="{{route('ahliwaris.index')}}" class="text-white">Dashboard</a>
@endsection
@section('content')
    <div class="offset-md-2 col-md-8 mt-5">
        <div class="card" style="border:0px">
            <div class="card-body p-5"> 
                <div class="h3">
                    Edit Profile
                </div>
                {{-- Pemesan --}}
                <p class="h5 font-weight-lighter mt-4 mb-2">Ahliwaris</p>
                <form method="POST" action="{{route('ahliwaris.profile.update')}}" id="ahliwarisBioFrm">
                        @csrf
                    <div class="form-group">
                    <label for="name" class="text-muted">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$userdata->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="birth" class="text-muted">Tanggal lahir</label>
                        <input type="date" name="birth" id="birth" class="form-control" value="{{$userdata->birth}}" required>
                    </div>
                    <div class="form-group">
                        <label for="address" class="text-muted">Alamat</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{$userdata->address}}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="text-muted">Telepon</label>
                        <input type="tel" name="phone" id="phone" class="form-control" value="{{$userdata->phone}}" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-muted">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$userdata->email}}" required>
                    </div>
                </form>
                {{-- <div class="form-group">
                    <label for="hub" class="text-muted">Hubungan</label>
                    <input type="text" name="hub" id="hub" class="form-control" required>
                </div> --}}
                {{-- End Pemesan --}}

                {{-- Button submit --}}
                <button type="submit" class="btn btn-info btn-block" form="ahliwarisBioFrm" >Save</button>
            </div>
        </div>
    </div>
@endsection