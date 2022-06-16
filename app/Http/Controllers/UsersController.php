<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Userモデルを使って、全ユーザーデータを取得
        $users = User::paginate(10);
        // viewの呼び出し
        return view('users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // 注目しているユーザーのプロフィールデータ取得
        $profile = $user->profile()->get()->first();
        // 注目しているユーザーの投稿一覧を取得
        $posts = $user->posts()->orderBy('id', 'desc')->paginate(10);

        // view の呼び出し
        return view('users.show', compact('user', 'profile', 'posts'));
    }
    
    // 注目しているユーザーがいいね投稿した一覧
    public function favorites($id)
    {
        // 注目するユーザーの情報を取得
        $user = User::find($id);
        // 注目するユーザーがいいねした投稿一覧を取得
        $posts = $user->favorites()->orderBy('id', 'desc')->paginate(5);
        
        // viewの呼び出し
        return view('users.favorites', compact('user', 'posts'));
    }
    
    // 注目しているユーザーがフォローしているユーザーの一覧表示
    public function followings($id)
    {
        // 注目するユーザーの情報取得
        $user = User::find($id);
        // 注目するユーザーがフォローしたユーザー一覧を取得
        $users = $user->followings()->paginate(10);
        
        // viewの呼び出し
        return view('users.followings', compact('user', 'users'));
    }
    
    // 注目しているユーザーのフォローワーの一覧表示
    public function followers($id)
    {
        // 注目するユーザーの情報取得
        $user = User::find($id);
        // 注目するユーザーのフォローワー一覧を取得
        $users = $user->followers()->paginate(10);
        
        // viewの呼び出し
        return view('users.followers', compact('user', 'users'));
    }
    
    // タイムラインデータ表示
    public function timelines()
    {
        //　タイムラインデータ取得 (ログインしているユーザーの投稿と、フォローしているユーザーの投稿一覧を取得)
        $posts = \Auth::user()->feed_microposts()->orderBy('id', 'desc')->paginate(5);
        
        // viewの呼び出し
        return view('users.timelines', compact('posts'));
    }
}
