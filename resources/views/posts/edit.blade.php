@extends('layouts.app')
@section('title', '投稿ID:' . $post->id . 'の編集')
@section('content')
    <div class="text-center mt-5">
        <h1 class="text-primary">投稿ID: {{ $post->id }}の編集</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3 mt-5">
            <!--投稿を更新するためPUTメソッドを使う-->
            {!! Form::open(['route' => ['posts.update', 'id' => $post->id], 'files' => true, 'method' => 'PUT' ]) !!}
                
                <!-- 1行 -->
                <div class="form-group">
                    {!! Form::label('title', '1. タイトル') !!}
                    {!! Form::text('title', $post->title ? $post->title : old('title'), ['class' => 'form-control']) !!}
                </div>
                
                <!-- 1行 -->
                <div class="form-group">
                    {!! Form::label('content', '2. 内容') !!}
                    {!! Form::text('content', $post->content ? $post->content : old('content'), ['class' => 'form-control']) !!}
                </div>
                
                <!-- 現在投稿されている画像を表示 -->
                <p class="text-success mt-4">※現在登録されている画像</p>
                <img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" alt="{{ $post->image }}" class="now_img">
                
                <!-- 1行 -->
                <div class="form-group mt-4">
                    {!! Form::label('image', '3. 画像') !!}<br>
                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'preview-uploader']) !!}
                    <!-- 画像プレビュー -->
                    <div id="preview" class="mt-4"></div>
                </div>

                {!! Form::submit('更新', ['class' => 'offset-sm-3 col-sm-6 btn btn-primary mt-5']) !!}
                {!! link_to_route('posts.show', '投稿ID: ' . $post->id . 'の詳細へ戻る' , ['id' => $post->id ],['class' => 'offset-sm-3 col-sm-6 btn btn-danger mt-5']) !!}
            {!! Form::close() !!}
            
            
        </div>
    </div>
@endsection