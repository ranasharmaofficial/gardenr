<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title') - {{ env('APP_NAME') }}</title>
      {{-- @yield('meta_tags') --}}

	  @include('frontend.includes.link')
      <style>
         :root {
            --rm-brand: #4caf50;
            --rm-brand-dark: #2e7d32;
            --rm-brand-light: #e8f5e9;
            --rm-surface: #f8fbf8;
         }
         body { background: #f7f9f7; }
         .rm-top-bar {
            background: linear-gradient(90deg, var(--rm-brand-dark) 0%, var(--rm-brand) 100%);
            color: #fff;
         }
         .rm-top-item, .rm-top-item span, .rm-social-btn, .rm-login-btn, .rm-call-label, .rm-call-number, .rm-footer-title, .rm-footer-links a, .rm-contact-text a, .rm-policy-card h3, .rm-policy-card p { transition: all 0.25s ease; }
         .rm-top-item:hover, .rm-social-btn:hover, .rm-login-btn:hover { color: #fff; opacity: 0.95; }
         .rm-social-btn, .rm-login-btn {
            border: 1px solid rgba(255,255,255,0.2);
            background: rgba(255,255,255,0.12);
            color: #fff;
         }
         .rm-call-box {
            background: var(--rm-brand-light);
            border: 1px solid rgba(76,175,80,0.18);
            border-radius: 999px;
            padding: 10px 16px;
            box-shadow: 0 10px 25px rgba(46,125,50,0.12);
         }
         .rm-call-icon {
            background: var(--rm-brand);
            color: #fff;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
         }
         .rm-call-number { color: var(--rm-brand-dark); font-weight: 700; }
         .rm-brand-highlight {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
            padding: 7px 12px;
            border-radius: 999px;
            background: rgba(76,175,80,0.1);
            color: var(--rm-brand-dark);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
         }
         .rm-hero-card, .rm-policy-card, .rm-contact-card, .rm-about-card, .rm-home-highlight, .rm-footer-spotlight {
            box-shadow: 0 16px 45px rgba(0,0,0,0.08);
            border: 1px solid rgba(76,175,80,0.12);
         }
         .rm-about-card, .rm-policy-card, .rm-contact-card, .rm-home-highlight {
            background: #fff;
            border-radius: 22px;
            padding: 24px;
         }
         .rm-footer-spotlight {
            background: linear-gradient(135deg, #f2f8f2 0%, #e8f5e9 100%);
            border-radius: 24px;
            padding: 24px;
            margin-bottom: 24px;
         }
         .rm-footer-main { background: #0f2412; color: #f5fff5; }
         .rm-footer-title { color: #fff; }
         .rm-footer-links a { color: #d9f2dc; }
         .rm-footer-links a:hover, .rm-contact-text a:hover { color: #fff; padding-left: 4px; }
         .rm-footer-bottom { background: #08140a; color: #cfe9d2; }
      </style>
   </head>
   <body class="home-5">
            <!-- Preloader Start -->
            <div class="se-pre-con"></div>
            @include('frontend.includes.header')
            <!-- header end -->
            @yield('content')
            <!--footer-->
            @include('frontend.includes.footer')
            @include('frontend.includes.script')
        {{-- </div> --}}
    </body>
</html>

