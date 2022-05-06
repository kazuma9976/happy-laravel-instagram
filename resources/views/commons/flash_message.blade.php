@if (session('flash_message'))
  <p class="alert alert-success text-center" role="alert">{{ session('flash_message') }}</p>
@endif