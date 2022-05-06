<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User; // 追加
use App\Post; // 追加

class Comment extends Model
{
    // 取得したいカラムを指定
    protected $fillable = ['user_id', 'post_id', 'content',];
    
    /*
    * このコメントを所有する投稿。(Postモデルとの多対1の関係を定義)
    */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    /*
    * このコメントを所有するユーザー。(Userモデルとの多対1の関係を定義)
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
