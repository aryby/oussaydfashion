<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anon - eCommerce Website</title>

    <!--
    - favicon
  -->
    <link rel="shortcut icon" href="{{ asset('inspire/assets/images/logo/favicon.ico') }}" type="image/x-icon">

    <!--
    - custom css link
  -->
    <link rel="stylesheet" href="{{ asset('inspire/assets/css/style-prefix.css') }}">

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

</head>

<body>

    <div class="overlay" data-overlay></div>

    @include('site.partials.modal')

    @include('site.partials.notification')

    @include('site.partials.header')

    <main>
        @yield('content')
    </main>

    @include('site.partials.footer')

    <!--
    - custom js link
  -->
    <script src="{{ asset('inspire/assets/js/script.js') }}"></script>

    <!--
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
