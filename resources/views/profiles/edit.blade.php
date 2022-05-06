@extends('layouts.app')
@section('title', 'プロフィール編集')
@section('content')
    <div class="text-center mt-5">
        <h1 class="text-primary">{{ Auth::user()->name }}さんのプロフィール編集</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3 mt-5">
            <!--プロフィールを更新するため、methodはPUTを使う-->
            {!! Form::open(['route' => ['profiles.update', 'id' => $profile->id] ,'files' => true, 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('nickname', '1. ニックネーム') !!}
                    {!! Form::text('nickname', $profile->nickname ? $profile->nickname : old('nickname'),['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('gender', '2. 性別') !!}<br>
                    {!! Form::label('man', '男性') !!}
                    {!! Form::radio('gender', 'man', $profile->gender === 'man' ? true : false, ['id' => 'man']) !!}
                    {!! Form::label('woman', '女性') !!}
                    {!! Form::radio('gender', 'woman', $profile->gender === 'woman' ? true : false, ['id' => 'woman']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('introduction', '3. 自己紹介') !!}
                    {!! Form::text('introduction', $profile->introduction ? $profile->introduction : old('introduction'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('image', '4. アバターアイコン') !!}<br>
                    {!! Form::file('image') !!}
                </div>

                {!! Form::submit('プロフィール更新', ['class' => 'offset-sm-3 col-sm-6 btn btn-primary btn-block mt-5']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection