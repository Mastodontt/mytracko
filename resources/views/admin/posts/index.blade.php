@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 custom-container">
    @include('inc.alerts')
    <a href="{{ route('admin.posts.create') }}">
        <button class="btn btn-primary mb-3">{{ __('posts.add') }}</button>
    </a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('posts.title') }}</th>
                <th scope="col">{{ __('posts.content') }}</th>
                <th scope="col">{{ __('global.actions') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->content}}</td>
            <td class="d-flex">
                <div class="buttons d-flex">
                    <a title="{{  __('posts.edit') }}" class="mx-2" href="{{ route('admin.posts.edit',$post->id)}}">
                        <button class="btn btn-primary" type="button">
                            {{  __('global.edit') }}
                        </button>
                    </a>
                    <a title="{{  __('posts.show') }}" class="mx-2" href="{{ route('admin.posts.show',$post->id)}}">
                        <button class="btn btn-primary" type="button">
                            {{  __('posts.show') }}
                        </button>
                    </a>
                    <form action="{{ route('admin.posts.destroy',$post->id) }}" method="POST" onsubmit="return showConfirmation()">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger ml-3">{{ __('global.delete') }}</button>
                    </form>
                      
                  </button>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
      </table>
      {{ $posts->links() }}
</div>
@endsection
<script>
function showConfirmation() {
    let isConfirmed = confirm("Are you sure you want to delete post?");
    return isConfirmed;
} 
</script>