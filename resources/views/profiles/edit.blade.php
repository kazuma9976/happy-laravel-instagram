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
                
                <!-- 1行 -->
                <div class="form-group">
                    {!! Form::label('nickname', '1. ニックネーム') !!}
                    {!! Form::text('nickname', $profile->nickname ? $profile->nickname : old('nickname'),['class' => 'form-control']) !!}
                </div>
                
                <!-- 1行 -->
                <div class="form-group">
                    {!! Form::label('gender', '2. 性別') !!}<br>
                    {!! Form::radio('gender', 'man', $profile->gender === 'man' ? true : false, ['id' => 'man', 'class' => 'offset-2']) !!}
                    {!! Form::label('man', '男性') !!}
                    {!! Form::radio('gender', 'woman', $profile->gender === 'woman' ? true : false, ['id' => 'woman', 'class' => 'offset-2']) !!}
                    {!! Form::label('woman', '女性') !!}
                </div>
                
                <!-- 1行 -->
                <div class="form-group">
                    {!! Form::label('introduction', '3. 自己紹介') !!}
                    {!! Form::text('introduction', $profile->introduction ? $profile->introduction : old('introduction'), ['class' => 'form-control']) !!}
                </div>

                <!--そのユーザーのプロフィールの画像があるならばアバターアイコンを表示させる-->
                @if($profile->image)
                <p class="text-success mt-4">※現在登録されている画像</p>
                <img src="{{ Storage::disk('s3')->url('uploads/' . $profile->image) }}" alt="{{ $profile->image }}" class="now_avatar">
                <!--そうでなければno_image画像を表示させる。 -->
                @else
                <p class="text-danger mt-4">※プロフィール画像は未設定です</p>
                <img src="{{ asset('images/no_image.jpg') }}" alt="アバター画像は未設定です。" class="now_avatar">
                @endif
                
                <!-- 1行 -->
                <div class="form-group mt-4">
                    {!! Form::label('image', '4. 画像') !!}<br>
                    {!! Form::file('image', ['class' => 'form-control', 'id' => 'preview-uploader']) !!}
                    <!-- 画像プレビュー -->
                    <div id="preview" class="mt-4"></div>
                </div>

                {!! Form::submit('更新', ['class' => 'offset-sm-3 col-sm-6 btn btn-primary btn-block mt-5']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection