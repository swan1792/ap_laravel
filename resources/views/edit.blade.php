@extends('layouts')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header text-center">
          Edit Post
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        <form action="/post/{{$post->id}}" method="POST">
            @csrf
            {{-- @method('PUT') --}}
            @method('PUT')
            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="Name" name="name" value="{{old('name',$post->name)}}">
                <label for="name">Name</label>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave your description here" id="floatingTextarea2" style="height: 100px" name="description">{{old('description',$post->description)}}</textarea>
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
