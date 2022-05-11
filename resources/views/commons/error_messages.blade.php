@if ($errors->any())
    <div class="alert alert-danger offset-sm-4 col-sm-4" role="alert">
        @foreach ($errors->all() as $error)
            <p>※{{ $error }}</p>
        @endforeach
    </div>
@endif