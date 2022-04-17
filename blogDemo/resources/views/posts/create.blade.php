@extends('layouts.app')

@section('title')Create @endsection

@section('content')
    <form method="POST" action="{{ route('posts.store')}}">
        @csrf
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="Title" placeholder="">
        </div>
        <div class="mb-3">
            <label for="Email" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="Email" placeholder="">
        </div>
        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="Description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="Name" class="form-label">
                Post Creator
                <select name="name" id="Name" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <button class="btn btn-success">Create</button>
    </form>
@endsection
