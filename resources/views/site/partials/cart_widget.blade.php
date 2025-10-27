{{-- <div class="widget-header">
    <a href="{{ route('cart.index') }}" class="icontext">
        <div class="icon-wrap icon-xs bg2 round text-secondary"><i class="fa fa-shopping-cart"></i></div>
        <div class="text-wrap">
            <small>{{ __('Cart') }}</small>
            <span>{{ $cart_count }}
                 {{ $cart_count == 1 ? __('item') : __('items') }}</span>
        </div>

        
    </a>
</div> --}}


<a href="{{ route('cart.index') }}" class="action-btn">
    <ion-icon name="heart-outline"></ion-icon>
    <span class="count">{{ $cart_count }} </span>
</a>
