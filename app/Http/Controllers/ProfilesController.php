<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    // 新規プロフィールの登録画面
    public function create()
    {
        // 空のプロフィールインスタンスを表示
        $profile = new Profile();
        
        // viewの呼び出し
        return view('profiles.create', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    // 新規プロフィールの保存
    public function store(Request $request)
    {
        // validation
        // for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
        $this->validate($request, [
            'nickname' => 'required',
            'gender' => 'required',
            'introduction' => 'required',
            'image' => [
                'file',
                'mimes:jpeg,jpg,png'
            ]
        ]);
        
        // 入力値の取得
        $nickname = $request->input('nickname');
        $gender = $request->input('gender');
        $introduction = $request->input('introduction');
        $file = $request->file('image');
        
        // S3用
        $path = Storage::disk('s3')->putFile('/uploads', $file, 'public');
        
        // パスから、最後の「ファイル名.拡張子」の部分だけ取得
        $image = basename($path);
        
        // 入力情報をもとに新しいインスタンスを作成
        \Auth::user()->profile()->create(['nickname' => $nickname, 'gender' => $gender, 'introduction' => $introduction, 'image' => $image]);
        
        // トップページへリダイレクト
        return redirect('/top')->with('flash_message', 'プロフィールを作成しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
     
    // プロフィールの編集画面
    public function edit(Profile $profile)
    {
        // 注目しているプロフィールがログインしているユーザーのものならば
        if($profile->user_id === \Auth::id()) {
            // view(そのユーザーが持つプロフィールの編集画面)の呼び出し
            return view('profiles.edit', compact('profile'));
        } else {
            return redirect('/top');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
     
    // プロフィールの更新
    public function update(Request $request, Profile $profile)
    {
        // 注目しているプロフィールがログインしているユーザーのものならば
        if($profile->user_id === \Auth::id()) {
            // vaidation
            // for image ref) https://qiita.com/maejima_f/items/7691aa9385970ba7e3ed
            $this->validate($request, [
                'nickname' => 'required',
                'gender' => 'required',
                'introduction' => 'required',
                'image' => [
                    'file',
                    'mimes:jpeg,jpg,png'
                ]
            ]);
            
            // 入力値の取得
            $nickname = $request->input('nickname');
            $gender = $request->input('gender');
            $introduction = $request->input('introduction');
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
                $image = $profile->image;
            }
            
            // 入力値をもとにインスタンスプロパティを作成
            $profile->nickname = $nickname;
            $profile->gender = $gender;
            $profile->introduction = $introduction;
            $profile->image = $image;
            
            // 入力した値をデータベースへ保存
            $profile->save();
            
            // Topページへリダイレクト
            return redirect('/top')->with('flash_message', 'プロフィールを更新しました');
        } else {
            return redirect('/top');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        
    }
}
