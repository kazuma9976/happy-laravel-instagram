<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User; // 追加
use App\Comment; // 追加

class Post extends Model
{
    // 取得したいカラムを指定
    protected $fillable = ['user_id', 'title', 'content', 'image', ];
    /**
     * この投稿を所有するユーザー（ Userモデルとの多対1の関係を定義）。
     */
     public function user() 
     {
        // Userデータを引っ張ってくる
        return $this->belongsTo(User::class);
     }
    /**
     * この投稿にコメントしたユーザー一覧（中間テーブルを介して取得）。
     * ref1) https://qiita.com/kurubiaburikaburu/items/3259a2d0c425d74aa97f
     * ref2) https://qiita.com/kazblog/items/ccaa369b1c862345d9a2
     */
     public function comment_users() 
     {
        return $this->belongsToMany(User::class, 'comments', 'post_id', 'user_id')->withTimestamps();
     }
     
      /**
     * この投稿に紐づいたコメント一覧（ Commentモデルとの多対1の関係を定義）。
     */
     public function comments() 
     {
        return $this->hasMany(Comment::class);
     }
     
     /**
     * この投稿にいいねをしたユーザー一覧（中間テーブルを介して）
     */
    public function favorite_users()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }
}
