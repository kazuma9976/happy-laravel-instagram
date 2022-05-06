@extends('layouts.app')
@section('title', '新規画像投稿')
@section('content')
    <div class="text-center mt-5">
        <h1 class="text-primary">新規画像投稿</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3 mt-5">

            {!! Form::open(['route' => ['posts.store'], 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('title', '1. タイトル') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('content', '2. 内容') !!}
                    {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('image', '3. 画像') !!}<br>
                    {!! Form::file('image') !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'offset-sm-3 col-sm-6 btn btn-primary btn-block mt-5']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection