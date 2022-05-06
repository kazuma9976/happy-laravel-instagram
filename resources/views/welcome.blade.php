@extends('layouts.app')
@section('title', '会員制写真投稿サイト')
@section('content')
    <div class="text-center mb-2">
        <h1 class="text-primary">Come on, post your photos!</h1>
    </div>
    <div class="row">
        {!! link_to_route('signup.get', '新規会員登録', [], ['class' => 'offset-sm-4 col-sm-4 btn btn-primary mt-5']) !!}
    </div>
    <div class="row mb-5">
        {!! link_to_route('login', 'ログイン', [], ['class' => 'offset-sm-4 col-sm-4 btn btn-danger mt-5']) !!}
    </div>
    <div class="row mt-5">
        @foreach($posts as $post)
        <div class="col-sm-3 mb-3"><img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" alt="{{ $post->image }}" class="image_title"></div>
        @endforeach   
    </div>
@endsection
