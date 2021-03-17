@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (Session::has('fails'))
    <div class="alert alert-danger">
        {{ session('fails') }}
    </div>
@endif
