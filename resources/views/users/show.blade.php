@extends('layouts.app')

@section('content')

<div class="card-header">{{$user->name}}の投稿</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($user->posts  as $post)
        <div class="card">
            <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <!-- 他のモデルからの紐付けは他のモデルを介入することで書くことが出来る。 -->
            <h5 class="card-title">タイトル：
            <a href="{{route('posts.index' , ['category_id' =>$post->category_id])}}">
                {{$post->category->category_name}}
            </a>
            </h5>
            <h5 class="card-title">
            投稿者：
            <a href="{{route('users.show', $post->user_id)}}">
              {{$post->user->name}}
            </a>
            </h5>
            <p class="card-text">{{$post->content}}</p>
            <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">詳細ページ</a>
            </div>
        </div>
    @endforeach     
</div>
@endsection
