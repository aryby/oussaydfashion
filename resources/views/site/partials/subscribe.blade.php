<section class="section-subscribe bg-primary padding-y-lg">
    <div class="container">
        <p class="pb-2 text-center white">
            {{ __('subscribe.tagline') }}</p>

        <div class="row justify-content-md-center">
            <div class="col-lg-4 col-sm-6">
                @livewire('subscribe-form')
                <small class="form-text text-center text-white-50">{{ __('subscribe.privacy_note') }}.
                </small>
            </div>
        </div>
    </div>
</section>
