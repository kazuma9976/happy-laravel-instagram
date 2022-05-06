@extends('layouts.app')
@section('title', 'ログイン')
@section('content')
    <div class="text-center mt-5">
        <h1 class="text-primary">ログイン</h1>
    </div>
    
    <div class="row mt-5">
        <div class="col-sm-6 offset-sm-3">
            
            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', '1. メールアドレス') !!}
                    {!! Form::email('email', old('email'),['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('password', '2. パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                
                {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block mt-5']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection