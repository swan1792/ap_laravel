@extends('layouts')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center">
          Edit Post
        </div>
        <form action="/post/{{$post->id}}" method="POST">
            @csrf
            {{-- @method('PUT') --}}
            @method('PUT')
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name" value="{{$post->name}}" required>
                <label for="name">Name</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave your description here" id="floatingTextarea2" style="height: 100px" name="description" required>{{$post->description}}</textarea>
                <label for="description" >Description</label>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary active fw-bold" >Submit</button>
                <a href="/post" class="btn btn-success active fw-bold">Back</a>
            </div>
          </form>
    </div>
</div>
@endsection
