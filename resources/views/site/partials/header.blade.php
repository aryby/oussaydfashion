{{-- <div class="overlay" data-overlay></div> --}}

<header>
    <div class="header-top">
        <div class="container">
            <ul class="header-social-container">
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-facebook"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-twitter"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-instagram"></ion-icon>
                    </a>
                </li>
                <li>
                    <a href="#" class="social-link">
                        <ion-icon name="logo-linkedin"></ion-icon>
                    </a>
                </li>
            </ul>
            <div class="header-alert-news">
                <p>
                    <b>Free Shipping</b>
                    This Week Order Over - $55
                </p>
            </div>
            <div class="header-top-actions"> <button class="btn dropdown-toggle"
                    style="border :none; text-transform :uppercase;" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ config('languages.' . app()->getLocale()) ?? config('languages.' . config('app.fallback_locale')) }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach (config('languages') as $locale => $lang)
                        <a class="dropdown-item"
                            href="{{ route('langswitcher', ['locale' => $locale]) }}">{{ $lang }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container"> <a href="/" class="header-logo">
                {{-- <img src="{{ asset('inspire/assets/images/logo/logo.jpg') }}" alt="Anon's logo" width="120"
                    height="36"> --}}
                @if (config('settings.site_logo.attachment') != null)
                    <img src="{{ asset('uploads/' . config('settings.site_logo.attachment')) }}" alt=""
                        width="120" height="50">
                @else
                    <b>{{ config('settings.site_title.value') }}</b>
                @endif
            </a>
            <div class="header-search-container">
                <form action="{{ route('products.search') }}" class="search-wrap">
                    <input type="text" class="search-field" placeholder="{{ __('Search Products') }}" name="q"
                        value="{{ isset($q) ? $q : '' }}">
                    <button class="search-btn" type="submit">
                        <ion-icon name="search-outline"></ion-icon>
                    </button>
                </form>
            </div>
            <div class="header-user-actions"> {{-- <button class="action-btn">
                    <ion-icon name="person-outline"></ion-icon>
                </button> --}} {{-- <button class="action-btn">
                    <ion-icon name="heart-outline"></ion-icon>
                    <span class="count">0</span>
                </button>        <button class="action-btn">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                    <span class="count">0</span>
                </button> --}} {{-- her --}}
                <div class="widgets-wrap d-flex justify-content-end">
                    @auth
                        @include('site.partials.wishlist_widget')
                        @include('site.partials.cart_widget')
                    @endauth
                    @include('site.partials.user_widget')
                </div>
            </div>
        </div>
    </div>
    @include('site.partials.nav')

</header>
