@extends('layouts.app')

@section('title')
    Create
@endsection

@section('content')
    <form method="POST" action="{{ route('posts.update',['post'=>$post->id])}}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="Title" placeholder=""
                   value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="Description"
                      rows="3">{{$post->description}}</textarea>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">
                Post Creator
                <select name="userId" class="form-control">
                    @foreach ($users as $user)
                        @if($post->user_id === $user->id)
                            <option selected value="{{$user->id}}">{{$user->name}}</option>
                        @else
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endif
                    @endforeach
                </select>
            </label>
        </div>

        <button class="btn btn-primary">Update</button>
        @if($errors->any())
            <div class="m-auto text-center">
                @foreach($errors->all() as $error)
                    <li style="color: red;list-style: none"><strong>{{$error}}</strong></li>
                @endforeach
            </div>
        @endif
    </form>
@endsection
