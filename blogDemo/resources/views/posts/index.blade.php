@extends('layouts.app')

@section('title')Index @endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->description }}</td>
                <td>
                    <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>

                    <form class="d-inline-block" method="post" action="{{ route('posts.delete',['id'=>$post->id])}}">
                        @csrf
                        @method("delete")
                        <input type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"
                               value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
