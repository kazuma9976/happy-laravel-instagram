@if (session('flash_message'))
  <p class="alert alert-success offset-sm-4 col-sm-4" role="alert">{{ session('flash_message') }}</p>
@endif