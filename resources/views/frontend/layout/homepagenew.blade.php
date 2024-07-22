<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>
        @if (!empty(@$page->meta_title))
            {{@$page->meta_title}}
        @else
            {{env('APP_NAME')}}
        @endif
    </title>
    <meta name="keywords" content="{{@$page->meta_keywords}}">
    <meta name="description" content="{{@$page->meta_description}}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ asset('asset/frontend/test/images/logo.png') }}" type="image/x-icon">

    {{--Intl Tel Input
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/css/intlTelInput.css">
    --}}

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&amp;display=swap" rel="stylesheet">
    <link id="reset_style" rel="stylesheet" href="{{asset('asset/frontend/test/css/normalize.css')}}?v={{time()}}" />
    <link id="layout_main" rel="stylesheet" href="{{asset('asset/frontend/test/css/style.css')}}?v={{time()}}" />
    <link id="layout_menu" rel="stylesheet" href="{{asset('asset/frontend/test/css/menu.css')}}?v={{time()}}" />
    <link id="mobile_responsive" rel="stylesheet" href="{{asset('asset/frontend/test/css/responsive.css')}}?v={{time()}}" />
    <link id="accordion_layout" rel="stylesheet" href="{{asset('asset/frontend/test/css/accordion.css')}}?v={{time()}}" />

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("contact_us_frm").submit();
        }
    </script>

    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <header class="menu-section full-container">
      <div class="container flex f-row flex-m-p nav-flex">
            <div class="logo-con">
                <img src="{{ asset('asset/frontend/test/images/logo.png') }}" width="100" height="100" class="branding" alt="Media Play logo" />
            </div>
            <div class="menu-con">
                
                <div id="menu_burger" class="menu-burger h-large">
                    <span class="b-layer"></span>
                    <span class="b-layer"></span>
                    <span class="b-layer"></span>
                </div>
            </div>
        </div>
        <div id="bm_container" class="burger-container h-large h-mobile"></div>
    </header>
    @yield('content')
    </script>
</body>
</html>