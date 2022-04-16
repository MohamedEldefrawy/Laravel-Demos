@extends('layouts.app')

@section('title')Create @endsection

@section('content')
    <form method="POST" action="{{ route('posts.update',['post'=>$post['id']])}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Title</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder=""
                   value="{{$post["Title"]}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">{{$post["Description"]}}</textarea>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">
                Post Creator
                <select class="form-control">
                    @if($post["Name"] === "Ahmed")
                        <option value="1">Ahmed</option>
                    @elseif($post["Name"] === "Mohamed")
                        <option value="2">Mohamed</option>
                    @endif
                </select>
            </label>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
@endsection
