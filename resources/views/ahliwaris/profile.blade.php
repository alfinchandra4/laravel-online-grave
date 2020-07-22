<div class="col-md-3">
    <img style="border-radius:50%" src="https://i0.wp.com/static.cdn-cdpl.com/source/2/codepolitan-default-avatar.png"/>
    {{-- User Data --}}
    <div>
        <p>
            <h3><b>{{auth()->guard('user')->user()->name}}</b></h3>
            <i class="h6">{{auth()->guard('user')->user()->email}}</i>
        </p>
        <div>
            <a href="{{route('ahliwaris.profile')}}" class="btn btn-outline-secondary btn-block">
                EDIT PROFILE
            </a>
        </div>
    </div>

    {{-- Bank Acc Information
    <div class="card mt-4">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
    </div> --}}
</div>