@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 custom-container">
    @include('inc.alerts')
    <a href="{{ route('posts.create') }}">
        <button class="btn btn-primary mb-3">{{ __('posts.add') }}</button>
    </a>
    @foreach($posts as $post)
    <div class="card custom-card mb-4">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                <h6 class="mb-0">{{ $post->title }}</h6>
                </div>
                <div class="d-flex align-items-center">
                    @canEdit($post)
                    <div class="buttons d-flex">
                        <a href="{{ route('posts.edit',$post->id) }}">
                            <button class="btn btn-secondary">{{ __('global.edit') }}</button>
                        </a>
                       
                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST" onsubmit="return showConfirmation()">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger ml-3">{{ __('global.delete') }}</button>
                        </form>
                    </div>
                    @endcanEdit
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $post->content }}</p>
        </div>
        <div class="card-footer text-muted">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="bi bi-heart-fill text-danger me-2"></i>
                    <span>
                        <livewire:like-button 
                        :likes="$post->countLikes()" 
                        :liked="$post->isLikedBy(auth()->user())" 
                        :postid="$post->id" 
                        :userid="auth()->id()"
                        :createdby="$post->created_by"
                        />
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-chat-fill text-primary me-2"></i>
                    <span></span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="bi bi-share-fill text-secondary me-2"></i>
                    <span>{{ $post->author }}</span>
                </div>
            </div>
        </div>
    </div>

    @endforeach
    {{ $posts->links() }}
</div>
@endsection
<script>
let deleteConfirmation = @json(__('posts.confirm_deletion'));
function showConfirmation() {
    return confirm(deleteConfirmation);
} 
</script>