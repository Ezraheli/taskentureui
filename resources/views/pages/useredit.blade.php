@extends('layouts.app')

@section('content')


<div class="container-lg">
    <div class="row justify-content-center">
        <form action="{{ route('user.edit', Auth::user()->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input
                    type="text"
                    class="form-control"
                    name="name"
                    id="name"
                    placeholder=""
                    value="{{ Auth::user()->name }}"
                />
            </div>
            <div class="mb-3">
                <label for="bio" class="form-label">Bio</label>
                <textarea class="form-control" name="bio" id="bio" rows="3">{{Auth::user()->bio}}</textarea>
            </div>
            
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
        
    </div>
</div>

@endsection