@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="card-title">検索フォーム</h5>
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <form action="{{route('posts.search')}}" method="post">
                        @csrf
                            <input type="text" class="form-control input-lg" placeholder=""  name="search"/>
                            <span class="input-group-btn" style=" position: relative;top: -37px;left: 180px;">
                                <button class="btn btn-info " type="submit">
                                <i class="fas fa-search"></i>
                                </button>
                            </span>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card-header">Board</div>
@isset($search_result)
<!-- $search_resultがあるなら準備する必要がある -->
<h3 class="card-title p-4">{{$search_result}}</h3>
@endisset
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($posts as $post)
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
    <div class="pt-3">
       @if(isset($category_id)) 
        {{$posts->appends(['category_id'=>$category_id])->links()}}
       @else 
            {{ $posts->links() }}
       @endisset 
    </div>
</div>
@endsection
