<link rel="shortcut icon" type="image/x-icon"
    href="{{ asset('uploads/' . config('settings.site_favicon.attachment')) }}">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

<!-- Bootstrap4 files-->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('assets/css/bootstrap.css?v=1.0') }}" rel="stylesheet" type="text/css" />

<!-- Font awesome 5 -->
<link href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}" type="text/css" rel="stylesheet">

<!-- plugin: fancybox  -->
<script src="{{ asset('assets/plugins/fancybox/fancybox.min.js') }}" type="text/javascript"></script>
<link href="{{ asset('assets/plugins/fancybox/fancybox.min.css') }}" type="text/css" rel="stylesheet">

<!-- plugin: owl carousel  -->
<link href="{{ asset('assets/plugins/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/plugins/owlcarousel/assets/owl.theme.default.css') }}" rel="stylesheet">
<script src="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- custom style -->
<link href="{{ asset('assets/css/ui.css?v=1.0') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet"
    media="only screen and (max-width: 1200px)" />

<link href="{{ asset('assets/css/soft-design-system.min.css') }}" 
rel="stylesheet" />
    <!--
    - favicon
  -->
  <link rel="shortcut icon" href="{{ asset('inspire/assets/images/logo/favicon.ico')}}" type="image/x-icon">

  <!--
    - custom css link
  -->
  <link rel="stylesheet" href="{{ asset('inspire/assets/css/style-prefix.css')}}">
  <link rel="stylesheet" href="{{ asset('assets/css/custom-idea.css')}}">

  <!--
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

<!-- custom javascript -->

<!-- mobile fixes -->
<link href="{{ asset('css/mobile-fixes.css') }}" rel="stylesheet" media="only screen and (max-width: 768px)" />

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

  /* ============================================
     GLOBAL TYPOGRAPHY SYSTEM - UI/UX STANDARDS
     ============================================ */
  
  /* Base Typography */
  html {
    font-size: 16px;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  body {
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.6;
    color: #333333;
    letter-spacing: -0.01em;
    /* Add padding to body when mobile nav is visible */
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

  /* Headings - Consistent Hierarchy */
  h1, .h1 {
    font-family: 'Poppins', sans-serif;
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    color: #1a1a1a;
    letter-spacing: -0.02em;
    margin-bottom: 1.5rem;
  }

  h2, .h2 {
    font-family: 'Poppins', sans-serif;
    font-size: 2rem;
    font-weight: 600;
    line-height: 1.3;
    color: #1a1a1a;
    letter-spacing: -0.01em;
    margin-bottom: 1.25rem;
  }

  h3, .h3 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.75rem;
    font-weight: 600;
    line-height: 1.4;
    color: #2a2a2a;
    letter-spacing: -0.01em;
    margin-bottom: 1rem;
  }

  h4, .h4 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    line-height: 1.4;
    color: #2a2a2a;
    margin-bottom: 0.875rem;
  }

  h5, .h5 {
    font-family: 'Poppins', sans-serif;
    font-size: 1.25rem;
    font-weight: 500;
    line-height: 1.5;
    color: #333333;
    margin-bottom: 0.75rem;
  }

  h6, .h6 {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.5;
    color: #444444;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
  }

  /* Paragraphs */
  p {
    font-size: 1rem;
    line-height: 1.7;
    color: #555555;
    margin-bottom: 1rem;
  }

  /* Links */
  a {
    color: hsl(353, 100%, 78%);
    text-decoration: none;
    transition: color 0.3s ease, opacity 0.3s ease;
    font-weight: 500;
  }

  a:hover {
    color: hsl(353, 100%, 70%);
    text-decoration: underline;
  }

  a:focus {
    outline: 2px solid hsl(353, 100%, 78%);
    outline-offset: 2px;
  }

  /* Text Utilities */
  .text-muted {
    color: #6c757d !important;
    font-size: 0.9375rem;
  }

  .text-small {
    font-size: 0.875rem;
    line-height: 1.5;
  }

  .text-large {
    font-size: 1.125rem;
    line-height: 1.6;
  }

  .text-bold {
    font-weight: 700;
  }

  .text-semibold {
    font-weight: 600;
  }

  .text-medium {
    font-weight: 500;
  }

  .text-light {
    font-weight: 300;
  }

  /* Form Typography */
  label {
    font-family: 'Poppins', sans-serif;
    font-size: 0.9375rem;
    font-weight: 500;
    color: #333333;
    margin-bottom: 0.5rem;
    display: block;
  }

  input[type="text"],
  input[type="email"],
  input[type="tel"],
  input[type="number"],
  input[type="password"],
  textarea,
  select {
    font-family: 'Poppins', sans-serif;
    font-size: 1rem;
    font-weight: 400;
    color: #333333;
    line-height: 1.5;
  }

  input::placeholder,
  textarea::placeholder {
    color: #999999;
    font-weight: 400;
  }

  /* Buttons Typography */
  .btn {
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    letter-spacing: 0.02em;
    text-transform: none;
  }

  .btn-lg {
    font-size: 1.125rem;
    font-weight: 600;
  }

  .btn-sm {
    font-size: 0.875rem;
    font-weight: 500;
  }

  /* Card Typography */
  .card-title {
    font-family: 'Poppins', sans-serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 1rem;
  }

  .card-text {
    font-size: 1rem;
    line-height: 1.7;
    color: #555555;
  }

  /* List Typography */
  ul, ol {
    font-size: 1rem;
    line-height: 1.7;
    color: #555555;
  }

  li {
    margin-bottom: 0.5rem;
  }

  /* Blockquote */
  blockquote {
    font-size: 1.125rem;
    font-style: italic;
    color: #666666;
    border-left: 4px solid hsl(353, 100%, 78%);
    padding-left: 1.5rem;
    margin: 1.5rem 0;
  }

  /* Responsive Typography */
  @media (max-width: 768px) {
    html {
      font-size: 15px;
    }

    h1, .h1 {
      font-size: 2rem;
    }

    h2, .h2 {
      font-size: 1.75rem;
    }

    h3, .h3 {
      font-size: 1.5rem;
    }

    h4, .h4 {
      font-size: 1.25rem;
    }

    h5, .h5 {
      font-size: 1.125rem;
    }

    .card-title {
      font-size: 1.25rem;
    }
  }

  @media (max-width: 480px) {
    html {
      font-size: 14px;
    }

    h1, .h1 {
      font-size: 1.75rem;
    }

    h2, .h2 {
      font-size: 1.5rem;
    }

    h3, .h3 {
      font-size: 1.25rem;
    }
  }

  /* RTL Support for Arabic */
  [dir="rtl"] body,
  [dir="rtl"] h1, [dir="rtl"] .h1,
  [dir="rtl"] h2, [dir="rtl"] .h2,
  [dir="rtl"] h3, [dir="rtl"] .h3,
  [dir="rtl"] h4, [dir="rtl"] .h4,
  [dir="rtl"] h5, [dir="rtl"] .h5,
  [dir="rtl"] h6, [dir="rtl"] .h6,
  [dir="rtl"] p,
  [dir="rtl"] label,
  [dir="rtl"] .btn,
  [dir="rtl"] .card-title {
    font-family: 'Poppins', 'Cairo', 'Tajawal', Arial, sans-serif;
    text-align: right;
  }

  [dir="rtl"] blockquote {
    border-left: none;
    border-right: 4px solid hsl(353, 100%, 78%);
    padding-left: 0;
    padding-right: 1.5rem;
  }

  /* Accessibility - Focus States */
  *:focus-visible {
    outline: 2px solid hsl(353, 100%, 78%);
    outline-offset: 2px;
  }

  /* Print Styles */
  @media print {
    body {
      font-size: 12pt;
      line-height: 1.5;
      color: #000;
    }

    h1, h2, h3, h4, h5, h6 {
      color: #000;
      page-break-after: avoid;
    }
  }
</style>

