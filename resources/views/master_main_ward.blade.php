<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <title>@yield('title')</title>
    @section('header')
        <link rel="stylesheet" href="{{ url('css/all.css') }}">
        <link rel="stylesheet" href="{{ url('css/dashboards/dashboards-home.css') }}">
        <link rel="stylesheet" href="{{ url('css/login.css') }}">
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
@show
<!-- Piwik -->
    <script type="text/javascript">
        var _paq = _paq || [];
        _paq.push(["setCookieDomain", "*.134.213.154.56"]);
        _paq.push(["setDomains", ["*.134.213.154.56"]]);
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function () {
            var u = "//134.213.154.56/piwik/";
            _paq.push(['setTrackerUrl', u + 'piwik.php']);
            _paq.push(['setSiteId', 3]);
            var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.async = true;
            g.defer = true;
            g.src = u + 'piwik.js';
            s.parentNode.insertBefore(g, s);
        })();
    </script>
    <noscript><p><img src="//134.213.154.56/piwik/piwik.php?idsite=3" style="border:0;" alt=""/></p></noscript>
    <!-- End Piwik Code -->
</head>
<body>
<div class="outer-wrpaer container-fluid">
@include('partials.header-strip-main-ward')
<!-- The content area seciton comes here -->
@yield('content')
<!-- The content area seciton comes here -->
<!-- @include('partials.footer') -->
</div>
@section('footer')
    @include('partials.footer')
    <script src="{{ url('js/all.js') }}"></script>
    <script src="{{ url('js/common.js') }}"></script>
    <script src="{{ url('js/dashboards/dashboard-home-submenu.js') }}"></script>

@show
</body>
</html>
