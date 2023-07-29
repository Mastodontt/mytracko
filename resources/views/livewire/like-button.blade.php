
<div>
    @canLike($createdby)
    <button class="btn btn-info" wire:click="toggleLike">
        {{ $liked ?  __('global.unlike')  :  __('global.like')  }}
    </button>
    @endCanLike
    <span>{{ $likes }} {{ __('global.likes') }}</span>
</div>