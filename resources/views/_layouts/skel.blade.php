<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ config('app.name') }}</title>
        {{-- Tell the browser to be responsive to screen width --}}
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="<?= csrf_token() ?>">

        <link rel="shortcut icon" href="{{ asset('assets/adient-favicon.ico') }}" type="image/vnd.microsoft.icon" id="favicon" />

        <link rel="stylesheet" href="{{ asset( mix('/assets/css/styles.css') ) }}">

        {{-- Ionicons --}}
        {{--
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        --}}

        {{-- Asset::css() --}}

        {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
        {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
        <!--[if lt IE 9]>
            <script src="{{ asset( mix('/assets/js/ltIE9.js') ) }}"></script>
        <![endif]-->
        <script src="{{ asset( mix('/assets/js/scriptsHeader.js') ) }}"></script>

        {{ Asset::scripts('header') }}
    </head>

    <body class="fuelux fixed hold-transition @if( user()->isRoot() ) skin-red @else skin-blue @endif sidebar-mini">
        <div class="wrapper">

            @include('header-main')
            @include('sidebar-menu')

            {{-- Content Wrapper. Contains page content --}}
            <div class="content-wrapper">
                @section('content-header')
                    {{-- Content Header (Page header) --}}
                    {{--
                    <section class="content-header">
                        <h1>
                            Example Header
                            <small>Version 2.0</small>
                        </h1>

                        <ol class="breadcrumb">
                            <li>
                                <a href="#">
                                    <i class="fa fa-dashboard"></i>
                                    Home
                                </a>
                            </li>
                            <li class="active">
                                Example
                            </li>
                        </ol>
                    </section>
                    --}}
                @show

                {{-- Main content --}}
                <section class="content">
                    @include('notifications::flash')

                    @yield('content')
                </section>
          </div>
          <!-- /.content-wrapper -->


            @include('footer')
            @include('sidebar-user')

        </div>
        {{-- ./wrapper --}}

        <div id="loading-wrapper" style="display:none;">
            <img id="loading-image" src="{{  asset('assets/img/ajax-loader2.gif') }}" alt="Loading..." />
        </div>

        <div id="msg-box" class="error"></div>

        {{-- loading JS scripts --}}
        <script src="{{ asset( mix('/assets/js/scriptsFooter.js') ) }}"></script>
        {{ Asset::js('footer') }}

        <script type="text/javascript">
            var myAPP = new myAPP({
                baseUrl : '{{ URL::to('/') }}/',
                lang : '{{ Lang::locale() }}'
            });

            var appBaseUrl = myAPP.get('baseUrl');
            var appLang = myAPP.get('lang');

            $(document)
                    .ajaxStart(function () {
                        myAPP.showLoader();
                    })
                    .ajaxStop(function () {
                        myAPP.hideLoader();
                    })
                    .ajaxSuccess(function() {
                        initAfterAjax();
                    })
                    .ajaxError(function(event, jqxhr, settings, thrownError){
                        if ( jqxhr.status == 401 )
                        {
                            window.location = window.location;
                        }
                        else {
                            console.log( 'AJAX reqest status : '+ jqxhr.status );
                        }
                    });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <!-- ready -->
        {{ Asset::scripts('ready') }}

    </body>
</html>
