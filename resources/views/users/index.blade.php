@extends('layouts.app')
@section('title', '会員一覧')
@section('content')
    <div class="text-center mt-4">
        <h1 class="text-primary">会員一覧</h1>
    </div>
    <div class="row mt-4">
        <p class="text-success">現在の登録人数: {{ $users->total() }}人</p>
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
                    <!--そのユーザーのプロフィールがあるならばアバターアイコンを表示させる-->
                    @if($user->profile)
                    <img src="{{ Storage::disk('s3')->url('uploads/' . $user->profile->image) }}" alt="{{ $user->profile->image }}" class="avatar">
                    <!-- プロフィールが未設定の場合は、no_image画像を表示させる。 -->
                    @else
                    <img src="{{ asset('images/no_image.jpg') }}" alt="アバター画像は未設定です。" class="no_avatar">
                    @endif
                    {!! link_to_route('users.show', $user->name, ['id' => $user->id], []) !!}
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </table>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endsection