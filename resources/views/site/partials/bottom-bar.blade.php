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
  @php
    $myAccountRoute = route('account.edit');
  @endphp
  <a href="{{ $myAccountRoute }}" class="bottom-nav-item {{ request()->routeIs('account.*') ? 'active' : '' }}">
    <ion-icon name="person-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Profile') }}</span>
  </a>
  <a href="{{ route('account.orders') }}" class="bottom-nav-item {{ request()->routeIs('account.orders') ? 'active' : '' }}">
    <ion-icon name="bag-outline"></ion-icon>
    <span class="bottom-nav-label">{{ __('Orders') }}</span>
  </a>
  <div class="bottom-nav-item dropup">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px; margin: 0px; color: inherit;">
      <ion-icon name="language-outline"></ion-icon>
      <span class="bottom-nav-label">{{ config('languages.' . app()->getLocale()) ?? config('languages.' . config('app.fallback_locale')) }}</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      @foreach (config('languages') as $locale => $lang)
        <a class="dropdown-item" href="{{ route('set_language', ['locale' => $locale]) }}">{{ $lang }}</a>
      @endforeach
    </div>
  </div>
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
  <div class="bottom-nav-item dropup">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0px; margin: 0px; color: inherit;">
      <ion-icon name="language-outline"></ion-icon>
      <span class="bottom-nav-label">{{ config('languages.' . app()->getLocale()) ?? config('languages.' . config('app.fallback_locale')) }}</span>
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      @foreach (config('languages') as $locale => $lang)
        <a class="dropdown-item" href="{{ route('set_language', ['locale' => $locale]) }}">{{ $lang }}</a>
      @endforeach
    </div>
  </div>
</nav>
@endauth