@extends('layouts.app')
@section('title', '投稿ID: ' . $post->id . 'の詳細')
@section('content')
    <div class="text-center mt-5">
        <h1 class="text-primary">投稿ID: {{ $post->id }} の詳細</h1>
    </div>
    <table class="table table-bordered table-striped text-center mt-5">
        <tr>
            <th class="col42">投稿者</th>
            <td>
                <p>
                <!--その投稿のユーザーのプロフィールがあるならばアバターアイコンを表示させる-->
                @if($post->user->profile)
                <img src="{{ Storage::disk('s3')->url('uploads/' . $post->user->profile->image) }}" alt="{{ $post->user->profile->image }}" id="avatar">
                <!-- そうでなければno_image画像を表示させる。 -->
                @else
                <img src="{{ asset('images/no_image.jpg') }}" alt="アバター画像は未設定です。" id="no_avatar">
                @endif
                </p>
                {!! link_to_route('users.show', $post->user->name, ['id' => $post->user->id], []) !!}
            </td>
        </tr>
        <tr>
            <th>タイトル</th>
            <td>{{ $post->title }}</td>
        </tr>
        <tr>
            <th>内容</th>
            <td>{{ $post->content }}</td>
            
        </tr>
        <tr>
            <th>画像</th>
            <td><img src="{{ Storage::disk('s3')->url('uploads/' . $post->image) }}" alt="{{ $post->image }}"></td>
        </tr>
        <tr>
            <th>投稿日時</th>
            <td>{{ $post->created_at }}</td>
        </tr>
        <tr>
            <th>いいね/いいね解除</th>
            <td>
                @if(!Auth::user()->is_favorite($post->id))
                {!! Form::open(['route' => ['posts.favorite', 'id' => $post->id ]]) !!}
                    {!! Form::submit('いいね', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
                @else
                {!! Form::open(['route' => ['posts.unfavorite', 'id' => $post->id ], 'method' => 'DELETE']) !!}
                    {!! Form::submit('いいね解除', ['class' => 'btn btn-danger btn-block']) !!}
                {!! Form::close() !!}
                @endif
            </td>
        </tr>
        <tr>
            <th>いいねの数</th>
            <td class="text-success">{{ count($favorite_users) }} 個</td>
        </tr>
        <tr>
            <th>いいねした人の一覧</th>
            <td>
                @if(count($favorite_users) !== 0)
                    @foreach($favorite_users as $user)
                    <p>{!! link_to_route('users.show', $user->name , ['id' => $user->id ],[]) !!}</p>
                    @endforeach
                @else
                <div class="col-sm-12 text-center text-danger">
                    ※いいねした人はまだいません。
                </div>
                @endif
            </td>
        </tr>
    </table>

    @if($post->user->id === Auth::id())
    <div class="row mt-5">
        {!! link_to_route('posts.edit', '編集' , ['id' => $post->id ],['class' => 'btn btn-success offset-sm-3 col-sm-6']) !!}
    </div>
        {!! Form::open(['route' => ['posts.destroy', 'id' => $post->id ], 'method' => 'DELETE']) !!}
    <div class="row mt-3">
            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-block offset-sm-3 col-sm-6', 'onclick' => 'return confirm("投稿を削除します。よろしいですか？")']) !!}
    </div>
        {!! Form::close() !!}
    @endif
    
    <div class="text-center text-success mt-5">
        <h2>コメント一覧</h2>
    </div>
    <div class="row">
        @if(count($comments) !== 0)
        <table class="table table-bordered table-striped text-center mt-5">
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>コメント内容</th>
                <th>投稿日時</th>
            </tr>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->user->name }}</td>
                <td>{{ $comment->content }}</td>
                <td>{{ $comment->created_at }}</td>
            </tr>
            @endforeach
        </table>
        @else
    </div>
    <div class="row mt-5">
        <div class="col-sm-12 text-center text-danger">
            ※コメントはまだありません。
        </div>
    </div>
        @endif
    <div class="col-sm-6 offset-sm-3 mt-4 mb-5">
        {!! Form::open(['route' => ['comments.store', 'id' => $post->id ]]) !!}
            <div class="form-group">
                {!! Form::label('content', 'コメント記入:') !!}
                {!! Form::text('content', old('content'), ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('コメント投稿', ['class' => 'btn btn-primary btn-block mt-4']) !!}
        {!! Form::close() !!}
    </div>
    
@endsection