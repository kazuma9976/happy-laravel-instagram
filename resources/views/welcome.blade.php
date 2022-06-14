@extends('layouts.app')
@section('title', 'Instagram Clone')
@section('content')
    <div class="text-center mb-5">
        <h1 class="text-danger" id="first">Come on, post your photos!</h1>
    </div>
    <div class="row">
        @foreach($posts as $post)
        <div class="col-sm-3 mb-3"><img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" alt="{{ $post->image }}" class="image_title"></div>
        @endforeach   
    </div>
@endsection
