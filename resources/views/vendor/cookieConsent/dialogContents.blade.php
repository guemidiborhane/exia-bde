<div class="fixed-bottom bg-dark text-white cookies-banner js-cookie-consent cookie-consent">
    <div class="container pt-4">
        <h5 class="text-warning mb-4">Cookies</h5>
        <p class="cookie-consent__message float-left">
            {!! trans('cookieConsent::texts.message') !!}
        </p>

        <button
            class="js-cookie-consent-agree cookie-consent__agree btn btn-outline-warning btn-sm float-right mb-2">
            {{ trans('cookieConsent::texts.agree') }}
        </button>
    </div>

</div>
