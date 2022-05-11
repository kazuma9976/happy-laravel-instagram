@if ($errors->any())
    <ul class="alert alert-danger offset-sm-3 col-sm-6" role="alert">
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif