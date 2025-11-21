<div>
    <div class="payment-section">
        @if (isset($cards) && count($cards) > 0)

            @foreach ($cards as $card)
                <div class="wrapper">
                    <div class="wrapper-item">
                        <div class="wrapper-img">
                        </div>
                        <div class="wrapper-content">
                            <h5 class="heading">{{ $card->brand }}</h5>
                            <p class="paragraph">{{ $card->last_four }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <button class="shop-btn" wire:click='makeDefault({{$card->id}})'>
                            @if ($card->is_default)
                                {{__('front.default')}}
                                @else
                                {{__('front.mark_as_default')}}
                            @endif
                        </button>
                        <button class="shop-btn"wire:click='delete({{$card->id}})'>{{__('admin.delete')}}</button>
                    </div>

                </div>
            @endforeach
            {{$cards->links()}}
        @else
        <p class="text-center">{{ __('front.empty_payment_method') }}</p>


        @endif

        <hr>

    </div>
</div>
<script>
 window.addEventListener('success', function(){
    toastr.success('you updated your card successfully!');
});
 window.addEventListener('success_delete', function(){
    toastr.success('you deleted your card successfully!');
});

</script>
