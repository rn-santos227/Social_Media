@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a Post</div>

                <div class="card-body">
                    <form method="POST" action="/post/create">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-md-4 col-form-label">Title:</label>
                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title">
                            </div>
                        </div>    

                        <div class="form-group">
                            <label for="content" class="col-md-4 col-form-label">Content:</label>
                            <div class="col-md-12">
                                <textarea id="content" class="form-control" name="content">
                                </textarea>
                            </div>
                        </div> 

                        <div class="form-group">
                            <div class="col-md-12 text-md-right">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>                 
                    </form>
                </div>
            
            </div>

            @foreach ($posts as $post)
            <div class="card" style="margin-top: 10px">
                <div class="card-header">{{ $post->title }} <div class="text-md-right">Score: {{ $post->score }}</div></div>
                <div class="card-body">
                    <div class="form-group">
                        {{ $post->content }}
                    </div>            
                </div> 
                <div class="card-footer">
                    <div class="form-group row">
                        <form method="POST" action="/post/upvote">
                            @csrf
                            <div class="col-md-12 text-md-right">
                                <input type="hidden" value="{{ $post->id }}" name="id" id="id">
                                <button style="width: 150px" type="submit" class="btn btn-success">
                                    Upvote
                                </button>
                            </div>                    
                        </form>
                        <form method="POST" action="/post/downvote">
                            <div class="col-md-12 text-md-right">
                                @csrf
                                <input type="hidden" value="{{ $post->id }}" name="id" id="id">
                                <button style="width: 150px" type="submit" class="btn btn-danger">
                                    Downvote
                                </button>
                            </div>                    
                        </form>
                    </div>
                </div>
            </div>           
            @endforeach

        </div>
    </div>
</div>
@endsection
