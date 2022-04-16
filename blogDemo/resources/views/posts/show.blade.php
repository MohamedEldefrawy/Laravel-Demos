@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Post info
        </div>
        <div class="card-body">
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Title: &nbsp;</span>{{$post["Title"]}}
            </div>
            <div>
                <span style="font-size: 1rem; font-weight: bold">Name: &nbsp;</span>{{$post["Description"]}}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Post Creator info
        </div>
        <div class="card-body">
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Name: &nbsp;</span>{{$post["Name"]}}
            </div>
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Email: &nbsp;</span>{{$post["Email"]}}
            </div>
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Created At: &nbsp;</span>{{$post["Created At"]}}
            </div>
        </div>
    </div>
@endsection
