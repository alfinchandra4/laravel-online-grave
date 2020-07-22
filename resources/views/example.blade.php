<form method="POST" action="/example" enctype="multipart/form-data">
    @csrf
    <input type="file" name="doc" id="doc"/>
    <button type="submit">simpan</button>
</form>