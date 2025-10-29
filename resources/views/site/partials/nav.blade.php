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
            <div class="header-top-actions">
                <select name="currency">
                    <option value="usd">USD &dollar;</option>
                    <option value="eur">EUR &euro;</option>
                </select>
                <select name="language" onchange="location = this.value;">
                    <option value="{{ route('langswitcher', 'en') }}" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                    <option value="{{ route('langswitcher', 'ar') }}" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                </select>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="container">
            <a href="#" class="header-logo">
                <img src="{{ asset('inspire/assets/images/logo/logo.svg') }}" alt="Anon's logo" width="120"
                    height="36">
            </a>
            <div class="header-search-container">
                <input type="search" name="search" class="search-field" placeholder="Enter your product name...">
                <button class="search-btn">
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>
            <div class="header-user-actions">
                <button class="action-btn">
                    <ion-icon name="person-outline"></ion-icon>
                </button>
                <button class="action-btn">
                    <ion-icon name="heart-outline"></ion-icon>
                    <span class="count">0</span>
                </button>
                @include('site.partials.cart_widget')
            </div>
        </div>
    </div>
    <nav class="desktop-navigation-menu">
        <div class="container">
            <ul class="desktop-menu-category-list">
                <li class="menu-category">
                    <a href="{{ url('/') }}" class="menu-title">Home</a>
                </li>
                <li class="menu-category">
                    <a href="#" class="menu-title">Categories</a>
                    <div class="dropdown-panel">
                        @foreach ($categories as $category)
                            <ul class="dropdown-panel-list">
                                <li class="menu-title">
                                    <a href="#">{{ $category->name }}</a>
                                </li>
                                @foreach ($category->children as $child)
                                    <li class="panel-list-item">
                                        <a href="#">{{ $child->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </li>
                @foreach ($categories as $category)
                    <li class="menu-category">
                        <a href="{{ route('categories.show', $category->slug) }}"
                            class="menu-title">{{ $category->name }}</a>
                        @if ($category->children->count() > 0)
                            <ul class="dropdown-list">
                                @foreach ($category->children as $child)
                                    <li class="dropdown-item">
                                        <a href="#">{{ $child->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="mobile-bottom-navigation">
        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
        </button>
        <button class="action-btn">
            <ion-icon name="bag-handle-outline"></ion-icon>
            <span class="count">0</span>
        </button>
        <button class="action-btn">
            <ion-icon name="home-outline"></ion-icon>
        </button>
        <button class="action-btn">
            <ion-icon name="heart-outline"></ion-icon>
            <span class="count">0</span>
        </button>
        <button class="action-btn" data-mobile-menu-open-btn>
            <ion-icon name="grid-outline"></ion-icon>
        </button>
    </div>
    <nav class="mobile-navigation-menu  has-scrollbar" data-mobile-menu>
        <div class="menu-top">
            <h2 class="menu-title">Menu</h2>
            <button class="menu-close-btn" data-mobile-menu-close-btn>
                <ion-icon name="close-outline"></ion-icon>
            </button>
        </div>
        <ul class="mobile-menu-category-list">
            <li class="menu-category">
                <a href="#" class="menu-title">Home</a>
            </li>
            @foreach ($categories as $category)
                <li class="menu-category">
                    <button class="accordion-menu" data-accordion-btn>
                        <p class="menu-title">{{ $category->name }}</p>
                        <div>
                            <ion-icon name="add-outline" class="add-icon"></ion-icon>
                            <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                        </div>
                    </button>
                    <ul class="submenu-category-list" data-accordion>
                        @foreach ($category->children as $child)
                            <li class="submenu-category">
                                <a href="#" class="submenu-title">{{ $child->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
