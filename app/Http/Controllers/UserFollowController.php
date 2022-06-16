<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store(Request $request, $id)
    {
        // ログインしているユーザーが、注目するユーザーをフォロー追加
        \Auth::user()->follow($id);
        
        // 直前ページにリダイレクト
        return back()->with('flash_message', 'フォローしました');
    }
    
    public function destroy($id)
    {
        // ログインしているユーザーが、注目するユーザーのフォロー解除
        \Auth::user()->unfollow($id);
        
        // 直前ページにリダイレクト
        return back()->with('flash_message', 'フォローを解除しました');
    }
}

