@extends('layouts.app')

@section('title')Create @endsection

@section('content')
    <form method="POST" action="{{ route('posts.update',['post'=>$post->id])}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""
                   value="{{$post->title}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{$post->description}}</textarea>
        </div>
        {{--        @dd($post->user_id)--}}

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">
                Post Creator
                <select class="form-control">
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
    </form>
@endsection
