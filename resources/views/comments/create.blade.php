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
                <form action="{{route('comments.store')}}" method="post">
                @csrf
                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Comment</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
                      </div>

                        <!-- 投稿画面には入っていないがuser_id登録画面に入れないとえらーをおこすのでhiddenとして書いている。 -->
                       <input type="hidden" name="user_id" value="{{Auth::id()}}"> 
                       <!-- 誰がどの投稿にコメントしたかを書いている -->
                       <input type="hidden" name="post_id" value="{{$post_id}}"> 

                      <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

</div>
@endsection
