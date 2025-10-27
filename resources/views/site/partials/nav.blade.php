<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                @forelse ($categories as $category)
                    @if ($category->items->isEmpty())
                        <li class="nav-item font-weight-normal">
                            @if (Request::segment(2) == $category->slug)
                                <a class="nav-link active"
                                    href="{{ route('categories.show', $category->slug) }}">{{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name }}</a>
                            @else
                                <a class="nav-link"
                                    href="{{ route('categories.show', $category->slug) }}">{{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item dropdown has-megamenu">
                            <a class="nav-link dropdown-toggle"
                                href="{{ route('categories.show', $category->slug) }}" id="dropdown07"
                                data-bs-toggle="dropdown" aria-expanded="false">{{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name }}
                            </a>
                            <div class="dropdown-menu megamenu" role="menu" aria-labelledby="dropdown07">
                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <div class="col-megamenu">
                                            <h6 class="title">
                                                <a class="dropdown-item"
                                                    href="{{ route('categories.show', $category->slug) }}">{{ __('All') }}
                                                    {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name }}</a>
                                            </h6>
                                            <ul class="list-unstyled">
                                                @foreach ($category->items as $sub_category)
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('categories.show', $sub_category->slug) }}">{{ app()->getLocale() == 'ar' ? $sub_category->name_ar : $sub_category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @empty
                    <li class="nav-item">
                        <span class="nav-link disabled">{{ __('No active categories') }}</span>
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</nav>
