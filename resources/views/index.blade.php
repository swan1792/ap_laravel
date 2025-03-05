@extends('layouts')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
          Featured
        </div>
        <div class="card-body">
            @foreach ($data as $post)
            <h5 class="card-title"> {{$post->name}} </h5>
            <p class="card-text"> {{$post->description}} </p>
            <a href="#" class="btn btn-primary">View More</a><hr>
            @endforeach
        </div>
      </div>
</div>
@endsection
