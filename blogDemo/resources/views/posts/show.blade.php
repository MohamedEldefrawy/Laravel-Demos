@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Post Creator info
        </div>
        <div class="card-body">
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Name: &nbsp;</span>{{$post->user->name}}
            </div>
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Email: &nbsp;</span>{{$post->email}}
            </div>
            <div>
                <span
                    style="font-size: 1.2rem; font-weight: bold">Created At: &nbsp;</span>{{ $post->created_at->format('Y-m-d h:iA') }}
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            Post info
        </div>
        <div class="card-body">
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Title: &nbsp;</span>{{$post->title}}
            </div>
            <div>
                <span style="font-size: 1rem; font-weight: bold">Description: &nbsp;</span>{{$post->description}}
            </div>
        </div>
    </div>

    <hr>

    <h2>Comments</h2>
    <section id="comments" class="d-flex flex-column" style="gap: 2rem;">
        @foreach($post->comments as $comment)
            <div class="card">
                <div class="card-header">
                    <div>
                        <span style="font-size: 1.2rem; font-weight: bold">Name: &nbsp;</span>{{$comment->user->name}}
                    </div>
                    <div>
                        <span style="font-size: 1.2rem; font-weight: bold">Email: &nbsp;</span>{{$comment->user->email}}
                    </div>
                    <div>
                <span
                    style="font-size: 1.2rem; font-weight: bold">Created At: &nbsp;</span>{{ $comment->created_at->format('Y-m-d h:iA') }}
                    </div>
                </div>
                <div class="card-body">
                    {{$comment->comment}}
                </div>
                <div class="align-self-end">
                    <button class="btn btn-primary"><i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        @endforeach
    </section>
    <hr>
    <section id="createComment">
        <form method="POST" action="{{ route('comment.create')}}">
            @csrf
            <div class="mb-3">
                <label for="UserId" class="form-label">
                    Comment Creator
                    <select name="userId" id="UserId" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
            <div class="mb-3">
                <label for="Comment" class="form-label">Comment</label>
                <textarea name="comment" class="form-control" id="Comment" rows="3"></textarea>
            </div>
            <input name="commentable_id" type="hidden" value="{{$post->id}}">

            <button class="btn btn-success">Create</button>
        </form>
    </section>
@endsection
