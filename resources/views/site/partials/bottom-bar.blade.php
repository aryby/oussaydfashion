@auth
<nav class="mobile-bottom-nav d-md-none">
  <a href="{{ route('wishlist.index') }}" class="bottom-nav-item {{ request()->routeIs('wishlist.*') ? 'active' : '' }}">
    <ion-icon name="heart-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Wishlist') }}</span>
    @if(isset($wishlist_count) && $wishlist_count > 0)
      <span class="bottom-nav-badge">{{ $wishlist_count }}</span>
    @endif
  </a>
  <a href="{{ route('cart.index') }}" class="bottom-nav-item {{ request()->routeIs('cart.*') ? 'active' : '' }}">
    <ion-icon name="cart-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Cart') }}</span>
    @if(isset($cart_count) && $cart_count > 0)
      <span class="bottom-nav-badge">{{ $cart_count }}</span>
    @endif
  </a>
  <a href="{{ route('account.edit') }}" class="bottom-nav-item {{ request()->routeIs('account.*') ? 'active' : '' }}">
    <ion-icon name="person-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Profile') }}</span>
  </a>
  <a href="{{ route('account.orders') }}" class="bottom-nav-item {{ request()->routeIs('account.orders') ? 'active' : '' }}">
    <ion-icon name="bag-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Orders') }}</span>
  </a>
</nav>
@else
<nav class="mobile-bottom-nav d-md-none">
  <a href="{{ route('login') }}" class="bottom-nav-item">
    <ion-icon name="person-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Login') }}</span>
  </a>
  <a href="{{ route('cart.index') }}" class="bottom-nav-item {{ request()->routeIs('cart.*') ? 'active' : '' }}">
    <ion-icon name="cart-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Cart') }}</span>
    @if(isset($cart_count) && $cart_count > 0)
      <span class="bottom-nav-badge">{{ $cart_count }}</span>
    @endif
  </a>
  <a href="/" class="bottom-nav-item {{ request()->is('/') ? 'active' : '' }}">
    <ion-icon name="home-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Home') }}</span>
  </a>
  <a href="{{ route('register') }}" class="bottom-nav-item">
    <ion-icon name="add-circle-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Register') }}</span>
  </a>
</nav>
@endauth