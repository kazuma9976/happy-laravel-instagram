@extends('layouts.app')
@section('title', '会員制写真投稿サイト')
@section('content')
    <div class="text-center text-primary mb-2">
        <div id="first">Welcome to Instagram Clone!</div>
        <div id="second">Come on, post your photos!</div>
    </div>
    <div class="row mt-5">
        @foreach($posts as $post)
        <div class="col-sm-3 mb-3"><img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" alt="{{ $post->image }}" class="image_title"></div>
        @endforeach   
    </div>
@endsection
