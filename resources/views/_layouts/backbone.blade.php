<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        {{-- CSRF token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'APP') }} :: @yield('title')</title>

        {{-- header scripts --}}
        @section('head-scripts')
        @show

        {{-- header styles --}}
        @section('head-styles')
            <link rel="stylesheet" href="{{ asset(mix('/assets/css/combined.css')) }}">
        @show
    </head>

    <body class="hold-transition sidebar-mini fixed
        @auth
            {{ user()->isRoot() ? 'skin-red' : 'skin-blue-light' }}
        @else
            skin-yellow-light
        @endauth
    ">
        <div class="wrapper">
            @yield('body')
        </div>

        {{-- footer scripts --}}
        @section('foot-scripts')
            <script src="{{ asset(mix('/assets/js/combined.js')) }}"></script>
        @show

        {{-- inline scripts --}}
        <script type="text/javascript">
        @section('inline-scripts')
            $(document)
                    .ajaxStart(function () {
                        $('#loading-wrapper').fadeIn();
                    })
                    .ajaxStop(function () {
                        $('#loading-wrapper').fadeOut();
                    })
                    .ajaxSuccess(function() {
                        initAfterAjax();
                    });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        @show
        </script>
    </body>
</html>
