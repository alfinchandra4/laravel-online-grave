<div class="col-md-3">
    {{-- <img style="border-radius:50%" src="https://i0.wp.com/static.cdn-cdpl.com/source/2/codepolitan-default-avatar.png"/> --}}
    {{-- User Data --}}
    {{-- <div>
        <p>
            <h3><b>{{auth()->guard('admin')->user()->name}}</b></h3>
            <i class="h6">{{auth()->guard('admin')->user()->email}}</i>
        </p>
    </div> --}}

    {{-- Bank Acc Information --}}
    <div class="card mt-4">
        <div class="list-group">
            <a href="{{route('admin.index')}}" class="list-group-item list-group-item-action {{Route::currentRouteName() == "admin.index" ? 'active' : ''}}">
              Semua transaksi
            </a>
            <a href="{{route('admin.package')}}" class="list-group-item list-group-item-action {{Route::currentRouteName() == "admin.package" ? 'active' : ''}}">Daftar paket</a>
            <a href="{{route('admin.documents')}}" class="list-group-item list-group-item-action {{Route::currentRouteName() == "admin.documents" ? 'active' : ''}}">Dokumen jenazah</a>
            <a href="{{route('admin.payments')}}" class="list-group-item list-group-item-action {{Route::currentRouteName() == "admin.payments" ? 'active' : ''}}">Pembayaran</a>
            <a href="{{route('admin.gallery')}}" class="list-group-item list-group-item-action {{Route::currentRouteName() == "admin.gallery" ? 'active' : ''}}">Galeri</a>
          </div>
    </div>
</div>