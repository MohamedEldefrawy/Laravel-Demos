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
            @if(!$post->trashed())
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info">View</a>
                        <a href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary">Edit</a>
                        <form class="d-inline-block" method="post"
                              action="{{ route('posts.delete',['id'=>$post->id])}}">
                            @csrf
                            @method('delete')

                            <input type="submit" class="btn btn-danger"
                                   onclick="return confirm('Are you sure?')"
                                   value="Delete">
                        </form>
            @else
                <tr>
                    <td class="text-center font-weight-bold"  colspan="4">Post has been Deleted</td>
                    <td>
                        <form class="d-inline-block" method="post"
                              action="{{ route('posts.retrieve',['id'=>$post->id])}}">
                            @csrf
                            <input type="submit" class="btn btn-warning"
                                   onclick="return confirm('Are you sure?')"
                                   value="Rollback">
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach

        </tbody>
    </table>
    <div>
        {{$posts->links()}}
    </div>
@endsection
