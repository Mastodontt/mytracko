@php
$postExists = isset($post);
$post = $postExists ? $post : optional(null);
$showExists = isset($show);
$show = $showExists ? 'disabled' : '';
@endphp

<div class="mb-3 col-md-12">
    <label for="title">{{ __('posts.title') }}</label>
    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title"value="{{ old('title') ?? $post->title }}" {{ $show }} required>
    @include('inc.form_err', ['key' => 'title'])
</div>

<div class="mb-3 col-md-12">
    <label for="content">{{ __('posts.content') }}</label>
    <textarea style="height:300px;" id="content" class="form-control  @error('content') is-invalid @enderror" type="textarea" name="content" {{ $show }}>{{ old('content') ?? $post->content }}</textarea>
    @include('inc.form_err', ['key' => 'content'])
</div>
<input type="hidden" name="created_by" value="{{ auth()->user()->id }}">