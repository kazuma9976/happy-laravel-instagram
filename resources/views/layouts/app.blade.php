<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title> @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="icon" href="{{ asset('images/favicon.ico')}} ">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>
        <header class="mb-4">
            <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
                @if(Auth::check())
                <a class="navbar-brand" href="/top">Laravel instagram</a>
                @else
                <a class="navbar-brand" href="/">Laravel instagram</a>
                @endif
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse mt-2" id="nav-bar">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav">
                        <!-- ユーザーがログインしている場合 -->
                        @if(Auth::check())
                        <li class="navbar-text bg-white p-2 mr-3">{!! link_to_route('users.show', Auth::user()->name , ['id' => Auth::id()], ['class' => 'text-success']) !!}</li>
                        <!-- ユーザーが新規プロフィール作成の場合  -->
                        @if(!Auth::user()->profile()->get()->first())
                        <li>{!! link_to_route('profiles.create', 'プロフィール登録', [], ['class' => 'nav-link']) !!}</li>
                        <!-- ユーザーがプロフィールを更新する場合 -->
                        @else
                        <li>{!! link_to_route('profiles.edit', 'プロフィール編集', ['id' => Auth::user()->profile()->get()->first()->id ], ['class' => 'nav-link']) !!}</li>
                        @endif
                        <li>{!! link_to_route('users.index', '会員一覧', [],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('posts.create', '新規画像投稿', [],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('users.timelines', 'タイムライン', [],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('posts.rankings', 'いいね投稿ランキング', [],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('users.favorites', 'お気に入り投稿', ['id' => Auth::id() ],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('users.followings', 'フォロー', ['id' => Auth::id() ],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('users.followers', 'フォローワー', ['id' => Auth::id() ],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('logout.get', 'ログアウト', [],['class' => 'nav-link']) !!}</li>
                        @else
                        <!-- ログイン前 -->
                        <li>{!! link_to_route('signup.get', '新規会員登録', [],['class' => 'nav-link']) !!}</li>
                        <li>{!! link_to_route('login', 'ログイン', [],['class' => 'nav-link']) !!}</li>
                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        
        <div class="container mb-5">
            @include('commons.flash_message')
            @include('commons.error_messages')
            @yield('content')
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>