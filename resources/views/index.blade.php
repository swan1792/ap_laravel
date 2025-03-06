@extends('layouts')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="/post/create" class="btn btn-success active fw-bold">New Post</a>
    </div>
    <div class="card">
        <div class="card-header text-center">
          Contents
        </div>
        <div class="card-body">
            @foreach ($data as $post)
            <h5 class="card-title"> {{$post->name}} </h5>
            <p class="card-text"> {{$post->description}} </p>
            <div class="d-flex">
                <a href="post/{{$post->id}}" class="btn btn-primary fw-bold active m-auto">View More</a>
                <a href="post/{{$post->id}}/edit" class="btn btn-warning fw-bold active m-auto">Edit</a>
                <form action="/post/{{$post->id}}" method="POST" class="m-auto">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger fw-bold active">Delete</button>
                </form>
            </div><hr>
            @endforeach
        </div>
      </div>
</div>
@endsection
