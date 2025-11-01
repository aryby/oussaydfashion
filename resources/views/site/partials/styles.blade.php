<link rel="shortcut icon" type="image/x-icon"
    href="{{ secure_asset('uploads/' . config('settings.site_favicon.attachment')) }}">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- jQuery -->
<script src="{{ secure_asset('assets/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{ secure_asset('assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<link href="{{ secure_asset('assets/css/bootstrap.css?v=1.0') }}" rel="stylesheet" type="text/css" />

<!-- Font awesome 5 -->
<link href="{{ secure_asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}" type="text/css" rel="stylesheet">

<!-- plugin: fancybox  -->
<script src="{{ secure_asset('assets/plugins/fancybox/fancybox.min.js') }}" type="text/javascript"></script>
<link href="{{ secure_asset('assets/plugins/fancybox/fancybox.min.css') }}" type="text/css" rel="stylesheet">

<!-- plugin: owl carousel  -->
<link href="{{ secure_asset('assets/plugins/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ secure_asset('assets/plugins/owlcarousel/assets/owl.theme.default.css') }}" rel="stylesheet">
<script src="{{ secure_asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- custom style -->
<link href="{{ secure_asset('assets/css/ui.css?v=1.0') }}" rel="stylesheet" type="text/css" />
<link href="{{ secure_asset('assets/css/responsive.css') }}" rel="stylesheet"
    media="only screen and (max-width: 1200px)" />

<link href="{{ secure_asset('assets/css/soft-design-system.min.css') }}" 
rel="stylesheet" />
    <!--
    - favicon
  -->
  <link rel="shortcut icon" href="{{ secure_asset('inspire/assets/images/logo/favicon.ico')}}" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="{{ secure_asset('inspire/assets/css/style-prefix.css')}}">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

<!-- custom javascript -->

<!-- mobile fixes -->
<link href="{{ secure_asset('css/mobile-fixes.css') }}" rel="stylesheet" media="only screen and (max-width: 768px)" />

<style>
  /* Ensure overlay never blocks clicks unless explicitly active */
  .overlay {
    pointer-events: none;
    opacity: 0;
    visibility: hidden;
  }
  .overlay.active {
    pointer-events: auto;
    opacity: 1;
    visibility: visible;
  }

  /* Mobile Bottom Navigation */
  .mobile-bottom-nav {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: #fff;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 8px 0 max(8px, env(safe-area-inset-bottom));
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
    z-index: 999;
    height: 60px;
  }

  .bottom-nav-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    flex: 1;
    padding: 4px 8px;
    color: #666;
    text-decoration: none;
    position: relative;
    transition: color 0.3s ease;
    font-size: 11px;
  }

  .bottom-nav-item ion-icon {
    font-size: 24px;
    margin-bottom: 4px;
  }

  .bottom-nav-label {
    font-size: 10px;
    text-transform: capitalize;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .bottom-nav-item.active {
    color: hsl(353, 100%, 78%);
  }

  .bottom-nav-item:hover {
    color: hsl(353, 100%, 78%);
    text-decoration: none;
  }

  .bottom-nav-badge {
    position: absolute;
    top: 0;
    right: 4px;
    background: hsl(353, 100%, 78%);
    color: #fff;
    border-radius: 10px;
    min-width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 600;
    padding: 0 4px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  /* Add padding to body when mobile nav is visible */
  body {
    padding-bottom: 60px;
  }

  @media (min-width: 768px) {
    .mobile-bottom-nav {
      display: none;
    }
    body {
      padding-bottom: 0;
    }
  }
</style>

