<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment; // 追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Postモデルを使って全投稿を降順で取得
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        // viewの呼び出し
        return view('top', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 空のPostモデル作成
        $post = new Post();
        // view の呼び出し
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // vaidation
        // for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => [
                'required',
                'file',
                'mimes:jpeg,jpg,png'
            ]
        ]);
        
        // 入力値の取得
        $title = $request->input('title');
        $content = $request->input('content');
        $file = $request->file('image');
        
        // S3用
        $path = Storage::disk('s3')->putFile('/uploads', $file, 'public');
        
        // パスから、最後の「ファイル名.拡張子」の部分だけ取得
        $image = basename($path);
        
        // 入力情報をもとに新しいインスタンスを作成
        \Auth::user()->posts()->create(['title' => $title, 'content' => $content, 'image' => $image]);
        
        // Topページへリダイレクト
        return redirect('/top')->with('flash_message', '新規画像投稿が完了しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // 空のCommentモデルを作成
        $comment = new Comment();
        // 注目するコメントに紐づいたコメント一覧を取得
        $comments = $post->comments()->get();
        
        // 注目する投稿にいいねをした人の一覧を取得
        $favorite_users = $post->favorite_users()->get();
        
        // view の呼び出し
        return view('posts.show', compact('post', 'comment', 'comments', 'favorite_users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // 注目している投稿がログインしている人のものならば
        if($post->user->id === \Auth::id()) {
            return view('posts.edit', compact('post'));
        } else {
            return redirect('/top');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // 注目しているユーザーのものならば
        if($post->user->id === \Auth::id()) {
            // validation
            // for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
            $this->validate($request, [
                'title' => 'required',
                'content' => 'required',
                'image' => [
                    'file',
                    'mimes:jpeg,jpg,png'
                ]
            ]);
            
            // 入力値の取得
            $title = $request->input('title');
            $content = $request->input('content');
            $file = $request->image;
            
            // 画像ファイルのアップロード
            // ref) https://qiita.com/ryo-program/items/35bbe8fc3c5da1993366
            if($file) {
                // S3用
                $path = Storage::disk('s3')->putFile('/uploads', $file, 'public');
                // パスから、最後の「ファイル名.拡張子」の部分だけ取得
                $image = basename($path);
                
            } else {
                // 画像ファイルが選択されていなければ、画像ファイルは元の名前のまま
                $image = $post->image;
            }
            
            // 入力値をもとにインスタンスプロパティを作成
            $post->title = $title;
            $post->content = $content;
            $post->image = $image;
            
            // 入力した値をデータベースへ保存
            $post->save();
            
            // Topページへリダイレクト
            return redirect('/top')->with('flash_message', '投稿ID: ' . $post->id . ' の画像投稿を更新しました');
        } else {
            return redirect('/top');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // 注目している投稿がログインしているユーザーのものならば
        if($post->user->id === \Auth::id()) {
            // データベースから削除
            $post->delete();
            // リダイレクト
            return redirect('/top')->with('flash_message', '投稿ID: ' . $post->id . ' の投稿を削除しました');
        } else {
            return redirect('/top');
        }
    }
    
    // いいねランキング表示
    public function rankings()
    {
        // いいね数が多い順に投稿のデータを取得(今回は上位3位)
        // Postモデルにある favorite_usersというリレーション名を使う。
        // ref) https://poppotennis.com/posts/laravel-withcount
        $posts = Post::withCount('favorite_users')->orderBy('favorite_users_count', 'desc')->paginate();
        
        // viewの呼び出し
        return view('posts.rankings', compact('posts'));
    }
    
    // キーワード検索
    public function search(Request $request)
    {
        // validation
        $this->validate($request, ['keyword' => 'required']);
        
        // 入力されたキーワードを取得
        $keyword = $request->input('keyword');
        
        // 検索(title、またはcontentで部分一致検索)
        // ref 1) https://biz.addisteria.com/laravel_where/#toc4
        // ref 2) https://style.potepan.com/articles/22072.html#LIKE
        $posts = Post::where('title', 'like', '%' . $keyword . '%')->orwhere('content', 'like', '%' . $keyword . '%')->paginate(10);
        // フラッシュメッセージのセット
        $flash_message = '検索キーワード: 『 '. $keyword .' 』に' . $posts->count() . '件ヒットしました!!';
        
        // viewの呼び出し
        return view('top', compact('posts', 'flash_message'));
    }
}
