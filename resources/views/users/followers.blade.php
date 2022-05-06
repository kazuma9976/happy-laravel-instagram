@extends('layouts.app')
@section('title',  'フォローワー会員一覧')
@section('content')
    <div class="text-center">
        <h1 class="text-primary">フォローワー会員一覧</h1>
        @if($users->total() !== 0)
        <div class="row mt-3">
            <p class="text-success">現在のフォローワー人数: {{ $users->total() }}人</p>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                    <th>投稿日時</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{!! link_to_route('users.show', $user->id , ['id' => $user->id ],[]) !!}</td>
                    <td>
                        @if($user->profile)
                        <img src="{{ Storage::disk('s3')->url('uploads/' . $user->profile->image) }}" alt="{{ $user->profile->image }}" class="avatar">
                        @else
                        <img src="{{ asset('images/no_image.jpg') }}" alt="アバター画像は未設定です" class="avatar">
                        @endif
                        {!! link_to_route('users.show', $user->name , ['id' => $user->id ],[]) !!}
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                </tr>
                @endforeach
            </table>
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
        @else
        <p class="mt-3 text-center text-danger">※まだフォローしてくれている会員はいません</p>   
        @endif
        
    </div>
@endsection