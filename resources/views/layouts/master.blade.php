<!DOCTYPE html>
<html class="loading"  lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<!-- Header -->
@include('assets.header')

@include('layouts.permissions')
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- Top Navbar-->
    @include('navbars.top_navbar')

    <!-- Side Navbar-->
    @include('navbars.side_navbar')

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- JS Files -->
    @include('assets.js')

</body>
<!-- END: Body-->
</html>