<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('paymob_iframe.document_title') }}</title>
</head>

<body>
    <iframe width="100%" height="800"
        src="https://accept.paymob.com/api/acceptance/iframes/786770?payment_token={{ $token }}">
    </iframe>
</body>

</html>
