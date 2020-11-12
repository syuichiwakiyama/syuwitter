<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Support\Arr;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q =\Request::query();

        if(isset($q['category_id'])){
            
            $posts =Post::latest()->where('category_id',$q['category_id'])->paginate(5);
            $posts->load('category','user');
            
    
            return view('posts.index',[
                'posts'       =>$posts,
                'category_id' =>$q['category_id'],
            ]);
        }else{
            $posts =Post::latest()->paginate(5);
            // 紐付けした別のモデルからいただく⬇️引数に入るのは先ほど作成した（モデル内の）関数である
            $posts->load('category','user');
            
    
            return view('posts.index',[
                'posts'=>$posts,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create',[

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        
        if($request->file('image')->isValid()) {
            $post  =new Post;
            // $input =$request->only($post->getfillable());
            
            // // 送信されてきたものをfileで読み込みpublic/imageに格納
            $post->user_id       =$request->user_id;
            $post->category_id   =$request->category_id;
            $post->content       =$request->content;
            $post->title         =$request->title; 


            // ->store('public/image');
            $filename = $request->file('image');
        

            $post->image=basename($filename);
 
            $post->save();
        } 

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // $idだったものをPostと＄ postに変換
    public function show(Post $post)
    {
        $post->load('category','user' ,'comments.user');
  

        return view('posts.show',[
            'post'=>$post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request)
    {
        // Post(モデル）からtitleを探す
        // orWhereで他のカラムから探すこともできる
        // 第２引数にlike、第３引数に%request->search%を入れて曖昧検索がすることが出来る
        $posts =Post::where('title','like' ,"%{$request->search}%")
                     ->orWhere('content' ,'like' ,"%{$request->search}%")
                     ->paginate(5);

        $seacrh_result =$request->search .'の検索結果' .$posts->total().'件';             
        return view('posts.index' ,[
                'posts'         =>$posts,
                'search_result' =>$seacrh_result
        ])  ;           

    }
}
