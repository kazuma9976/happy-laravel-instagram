<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function store(Request $request, $id)
    {
        // ログインしているユーザーが、注目する投稿にいいね追加
        \Auth::user()->favorite($id);
        
        // 直前ページにリダイレクト
        return back()->with('flash_message', 'いいねしました');
    }

    public function destroy($id)
    {
        // ログインしているユーザーが、注目する投稿にいいね解除
        \Auth::user()->unfavorite($id);
        
        // 直前ページにリダイレクト
        return back()->with('flash_message', 'いいねを解除しました');
    }
}
