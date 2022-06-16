@extends('layouts.app')
@section('title', '会員一覧')
@section('content')
    <div class="text-center mt-4">
        <h1 class="text-primary">会員一覧</h1>
    </div>
    <div class="row mt-4">
        <p class="text-success">※現在の登録人数: {{ $users->total() }}人</p>
        <table class="table table-bordered table-striped text-center">
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>登録日時</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{!! link_to_route('users.show', $user->id , ['id' => $user->id ],[]) !!}</td>
                <td>
                    @if($user->profile)
                        @if($user->profile->image)
                        <img src="{{ Storage::disk('s3')->url('uploads/' . $user->profile->image) }}" alt="{{ $user->profile->image }}" class="avatar">
                        @else
                        <img src="{{ asset('images/no_image.jpg') }}" alt="アバター画像は未設定です。" class="avatar">
                        @endif
                        {!! link_to_route('users.show', $user->name, ['id' => $user->id], []) !!}
                    @else
                    <img src="{{ asset('images/no_image.jpg') }}" alt="画像資料はありません" class="avatar">
                    {!! link_to_route('users.show', $user->name, ['id' => $user->id], []) !!}
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </table>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection