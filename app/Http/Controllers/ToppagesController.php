<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // 追加

class ToppagesController extends Controller
{
    // Top page表示
    public function index()
    {
        // Postモデルを使って全投稿データを表示
        $posts = Post::all();
        // viewの呼び出し
        return view('welcome', compact('posts'));
    }
}
