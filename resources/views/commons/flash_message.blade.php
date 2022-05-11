@if (session('flash_message'))
  <p class="alert alert-success offset-sm-3 col-sm-6" role="alert">{{ session('flash_message') }}</p>
@endif