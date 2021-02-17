<div class="js-cookie-consent cookie-consent fixed-bottom bg-primary p-2 text-light text-center">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!} Read <a href="{{ route("privacy") }}">privacy policy</a>.
    </span>

    <button class="js-cookie-consent-agree cookie-consent__agree  btn btn-sm btn-warning">
        {{ trans('cookieConsent::texts.agree') }}
    </button>

</div>
