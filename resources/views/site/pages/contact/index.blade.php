@extends('site.app')

@section('title', __('Contact Us'))

@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">{{ __('Contact Us') }}</h2>
    </div>
</section>

<section class="section-content bg padding-y-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title mb-4">{{ __('Contact Us') }}</h3>
                        <form action="#" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">{{ __('First Name') }}</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">{{ __('Last Name') }}</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">{{ __('Phone') }}</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="message">{{ __('Message') }}</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Send Message') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Contact Information') }}</h5>
                        @if(config('settings.phone_enquiry.value'))
                        <div class="mb-3">
                            <p><strong><ion-icon name="call-outline"></ion-icon> {{ __('Phone') }}:</strong></p>
                            <p><a href="tel:{{ config('settings.phone_enquiry.value') }}">{{ config('settings.phone_enquiry.value') }}</a></p>
                        </div>
                        @endif
                        
                        <div class="mb-3">
                            <p><strong><ion-icon name="mail-outline"></ion-icon> @lang('Email'):</strong></p>
                            <p>{{ config('settings.site_title.value') ?: @lang('contact.default_email') }}</p>
                        </div>
                        
                        <h5 class="card-title mt-4">{{ __('Follow Us') }}</h5>
                        <div class="social-links">
                            @if(config('settings.social_facebook.value'))
                            <a href="{{ config('settings.social_facebook.value') }}" target="_blank" rel="noopener noreferrer" class="social-link">
                                <ion-icon name="logo-facebook"></ion-icon>
                            </a>
                            @endif
                            @if(config('settings.social_twitter.value'))
                            <a href="{{ config('settings.social_twitter.value') }}" target="_blank" rel="noopener noreferrer" class="social-link">
                                <ion-icon name="logo-twitter"></ion-icon>
                            </a>
                            @endif
                            @if(config('settings.social_instagram.value'))
                            <a href="{{ config('settings.social_instagram.value') }}" target="_blank" rel="noopener noreferrer" class="social-link">
                                <ion-icon name="logo-instagram"></ion-icon>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

<style>
    .social-links {
        display: flex;
        gap: 15px;
    }
    
    .social-link {
        font-size: 24px;
        color: #007bff;
        transition: color 0.3s;
    }
    
    .social-link:hover {
        color: #0056b3;
    }
    
    .card-title {
        margin-bottom: 20px;
        font-weight: 600;
    }
</style>