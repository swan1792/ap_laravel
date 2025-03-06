@extends('layouts')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center">
          Viewing Post
        </div>
        <div class="card-body">
            <h5 class="card-title"> {{$post->name}} </h5>
            <p class="card-text"> {{$post->description}} </p>
        </div>
        <a href="/post" class="btn btn-success active fw-bold">Back</a>
    </div>
</div>
@endsection
