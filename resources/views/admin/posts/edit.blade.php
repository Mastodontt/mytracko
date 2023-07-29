@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5 custom-container">
    <a href="{{ route('admin.posts.index')}}">
        <button class="btn btn-secondary" type="button">{{ __('global.back') }}</button>
    </a>
    <div class="row">
        <div class="card-body mt-3">
            <form action="{{route('admin.posts.update',$post->id)}}" method="POST">
                @csrf
                <div class="row">
                    @include('posts.form')
                </div>
  
                <button class="btn btn-primary">{{ __('posts.edit') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection