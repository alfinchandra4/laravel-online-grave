@if (session()->get('success'))
    <div class="alert alert-success" id="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        {{session()->get('success')}}
        <br>
    </div>
@endif

@if (session()->get('error'))
    <div class="alert alert-danger" id="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="ace-icon fa fa-times"></i>
        </button>
        {{session()->get('error')}}
        <br>
    </div>
@endif