@extends('layouts.app')

@section('content')

<div class="card-header">Board</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


        <div class="card">
            <div class="card-body">
                   @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  <!-- enctype="multipart/form-data"で画像が保存できるようになる -->
                <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                      <div class="form-group">
                        <label for="exampleInputEmail1">title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="title">
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlSelect1">category</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                          <option selected="">選択する</option>
                          <option value="1">book</option>
                          <option value="2">cafe</option>
                          <option value="3">travel</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Comment</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
                      </div>

                        <!-- 投稿画面には入っていないがuser_id登録画面に入れないとえらーをおこすのでhiddenとして書いている。 -->
                       <input type="hidden" name="user_id" value="{{Auth::id()}}"> 

                      <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

</div>
@endsection
