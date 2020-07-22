@extends('admin.app')

@section('title', 'Admin')
@section('content')
@include('admin.profile')
<div class="col-md-9">
    <h3>
        Gallery
    </h3>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <div>
                    <h5>
                        <b>Daftar foto</b>
                    </h5>
                </div>
                <div class="ml-auto mb-2">
                    <form method="POST" action="{{route('admin.gallery.store')}}" enctype="multipart/form-data">
                        @csrf
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-success" type="submit">Upload</button>
                          </div>
                        <div class="custom-file">
                          <input type="file" id="files" class="custom-file-input" name="image" accept="image/jpg, image/png, image/jpeg" required>
                          <label class="custom-file-label outputFile" id="outputFile">Choose file</label>                        
                        </div>
                      </div>
                    </form>
                </div>
           </div>
           <table  class="table table-striped table-bordered table-sm" style="width:100%; font-size:10pt">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Lokasi</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $photos = App\Gallery::orderByDesc('created_at')->paginate(10);
                @endphp
                @foreach ($photos as $photo)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td><img src="{{asset('/gallery/'.$photo->pathname)}}" height="100px" width="150px"/></td>
                        <td>{{$photo->pathname}}</td>
                        <td><a href="{{route('admin.gallery.remove', $photo->id)}}">Hapus</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection