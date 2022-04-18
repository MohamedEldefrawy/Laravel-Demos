@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Post info
        </div>
        <div class="card-body">
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Title: &nbsp;</span>{{$post->title}}
            </div>
            <div>
                <span style="font-size: 1rem; font-weight: bold">Name: &nbsp;</span>{{$post->description}}
            </div>
        </div>
    </div>

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
@endsection
