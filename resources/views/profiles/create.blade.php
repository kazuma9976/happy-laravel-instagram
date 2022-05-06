@extends('layouts.app')
@section('title', 'プロフィール登録')
@section('content')
    <div class="text-center mt-5">
        <h1 class="text-primary">{{ Auth::user()->name }}さんのプロフィール作成</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3 mt-5">

            {!! Form::open(['route' => ['profiles.store'] ,'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('nickname', '1. ニックネーム') !!}
                    {!! Form::text('nickname', old('nickname'),['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('gender', '2. 性別') !!}<br>
                    {!! Form::label('man', '男性') !!}
                    {!! Form::radio('gender', 'man', true, ['id' => 'man']) !!}
                    {!! Form::label('woman', '女性') !!}
                    {!! Form::radio('gender', 'woman', false, ['id' => 'woman']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('introduction', '3. 自己紹介') !!}
                    {!! Form::text('introduction', old('introduction'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('image', '4. アバターアイコン') !!}<br>
                    {!! Form::file('image') !!}
                </div>

                {!! Form::submit('プロフィール登録', ['class' => 'offset-sm-3 col-sm-6 btn btn-primary btn-block mt-5']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection