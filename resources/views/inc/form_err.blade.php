@if($errors->has($key))
    @foreach($errors->get($key) as $errorMessage)
        <p class="mt-2 text-danger">
            {{ $errorMessage }}
        </p>
    @endforeach
@endif