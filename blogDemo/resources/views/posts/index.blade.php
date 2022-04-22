@extends('layouts.app')

@section('title')
    Index
@endsection

@section('content')
    <div class="text-center">
        <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success"><i class="bi bi-plus-circle"></i></a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
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
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at->format('Y-m-d h:iA') }}</td>
                    <td>
                        <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="btn btn-info"><i
                                class="bi bi-binoculars"></i></a>
                        <a href="{{ route('posts.edit', ['post' => $post['id']]) }}" class="btn btn-primary"><i
                                class="bi bi-pencil-square"></i></a>
                        <form class="d-inline-block" method="post"
                              action="{{ route('posts.delete',['id'=>$post->id])}}">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
            @else
                <tr>
                    <td class="text-center font-weight-bold" colspan="4">Post has been Deleted</td>
                    <td>
                        <form class="d-inline-block align-items-center" method="post"
                              action="{{ route('posts.retrieve',['id'=>$post->id])}}">
                            @csrf
                            <BUTTON type="submit" class="btn btn-warning"
                                    onclick="return confirm('Are you sure?')"
                            ><i class="bi bi-arrow-clockwise"></i></BUTTON>
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
