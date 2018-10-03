<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <script src="{{ asset('js/webfont.js') }}"></script>

    @include('admin.assets.css')

    @yield('css')
    
    <link rel="shortcut icon" href="{{ asset('bower_components/metro-asset/demo/default/media/img/logo/favicon.ico') }}" />
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">

        @include('admin.layout.header')

        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

            @include('admin.layout.aside')
            
            <div class="m-grid__item m-grid__item--fluid m-wrapper">

                <!-- BEGIN: Subheader -->
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title ">@yield('module')</h3>
                        </div>
                    </div>
                </div>
                <!-- END: Subheader -->

                <div class="m-content">

                    @yield('content')

                </div>

            </div>
        </div>

        @include('admin.layout.footer')

    </div>
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>

    @include('admin.assets.js')
    @include('sweetalert::alert')

    @yield('js')

</body>
</html>
