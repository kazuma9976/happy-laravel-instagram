@extends('layouts.app')
@section('title',  '投稿一覧')
@section('content')
    <!-- ref) https://techacademy.jp/magazine/11410 -->
    @if (isset($flash_message))
        <p class="alert alert-success text-center" role="alert">{{ $flash_message }}</p>
    @endif
    <div class="text-center">
        <h1 class="text-primary">投稿一覧</h1>
        <div class="row mt-3">
            <div class="col-sm-6 offset-sm-3">
                
                {!! Form::open(['route' => ['posts.search'], 'method' => 'get']) !!}
                    <div class="form-group">
                        {!! Form::label('keyword', 'キーワード検索', ['class' => 'text-danger']) !!}
                        {!! Form::text('keyword', old('title'), ['class' => 'form-control mb-3']) !!}
                    </div>
                    {!! Form::submit('検索', ['class' => 'btn btn-info btn-block mt-3']) !!}
                {!! Form::close() !!}
                
            </div>
        </div>
        
        
        
        @if($posts->total() !== 0)
        <div class="row mt-5">
            <p class="text-success">※現在の投稿件数: {{ $posts->total() }}件</p>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>投稿日時</th>
                </tr>
                @foreach($posts as $post)
                <tr>
                    <td>{!! link_to_route('posts.show', $post->id , ['id' => $post->id ],[]) !!}</td>
                    <td>
                        @if($post->user->profile)
                        <img src="{{ Storage::disk('s3')->url('uploads/' . $post->user->profile->image) }}" alt="{{ $post->user->profile->image }}" class="avatar">
                        @else
                        <img src="{{ asset('images/no_image.jpg') }}" alt="アバター画像は未設定です" class="avatar">
                        @endif
                        {!! link_to_route('users.show', $post->user->name , ['id' => $post->user->id ],[]) !!}
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->created_at }}</td>
                </tr>
                @endforeach
            </table>
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>
        @else
        <h2 class="mt-3 text-center text-danger">※投稿はまだありません</h2>
        @endif
    </div>
@endsection