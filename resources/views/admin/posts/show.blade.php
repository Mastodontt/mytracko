@extends('layouts.app')

@section('content')
<div class="container-fluid mt-5 custom-container">
    <a href="{{ route('admin.posts.index')}}">
        <button class="btn btn-secondary" type="button">{{ __('global.back') }}</button>
    </a>
    <div class="row">
        <div class="card-body mt-3">
                @csrf
                <div class="row">
                    @include('posts.form')
                </div>
        </div>
    </div>
</div>
@endsection