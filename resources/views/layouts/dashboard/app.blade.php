<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
    class="loading">

<head>
    @include('layouts.dashboard._head')
</head>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    @include('layouts.dashboard._header')
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('layouts.dashboard._sidebar')
    @yield('content')

    <!-- ////////////////////////////////////////////////////////////////////////////-->
    @include('layouts.dashboard._footer')
     @if (Auth::guard('admin')->check())
       <script>
            layout = "admin";
            adminId= "{{ auth('admin')->user()->id }}";
            showOrderRoute = "{{route('dashboard.orders.show',':id')}}";
            contactIndexRoute= "{{ route('dashboard.contacts.index') }}"
        </script>
    @endif
    <script src="{{ asset('build/assets/app-a95d7a31.js') }}"></script>

    @include('layouts.dashboard._scripts')
</body>

</html>
