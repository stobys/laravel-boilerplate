<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="csrf-token" content="<?= csrf_token() ?>">

        <title>{{ env('APP_NAME') }} :: @yield('title')</title>

        <link rel="stylesheet" href="{{ asset(mix('/assets/css/combined.css')) }}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

        <!--[if lt IE 9]>
            <script src="{{ asset(mix('/assets/js/combined-IE9.js')) }}"></script>
        <![endif]-->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

	{{--
		SKINS  : skin-blue, skin-black, skin-purple, skin-yellow, skin-red, skin-green
		LAYOUT : fixed, layout-boxed, layout-top-nav, sidebar-collapse, sidebar-mini
	--}}
	<body class="hold-transition sidebar-mini fixed
        @auth
            {{ user()->isRoot() ? 'skin-red' : 'skin-blue-light' }}
        @else
            skin-yellow
        @endauth
    ">
		<div class="wrapper">
  			{{--// main header //--}}
			@include('header')

  			{{--// left side column. contains the logo and sidebar //--}}
  			<aside class="main-sidebar">
    			<section class="sidebar">
      				{{--// sidebar user panel (optional) //--}}
					@include('sidebar-header')

      				{{--// sidebar menu //--}}
      				@include('sidebar-menu')
    			</section>
  			</aside>

  			{{--// content wrapper. contains page content //--}}
  			<div class="content-wrapper">
    			{{--// content header (page header) //--}}
				@include('content-header')

    			{{--// main content //--}}
    			<section class="content container-fluid">
                    @include('_partials.flash_message')
					@yield('content')
    			</section>
  			</div>

  			{{--// main footer //--}}
			@include('footer')

			{{--// control sidebar //--}}
			@include('sidebar-control')

		</div>

		{{-- required JS scripts --}}
		<script src="{{ asset(mix('/assets/js/combined.js')) }}"></script>
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
                            console.log('AJAX reqest status : '+ jqxhr.status);
                        }
                    });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function(){
                initAfterAjax();

                $('#flash-overlay-modal').modal();
            });
        </script>

        <!-- ready -->
        {{-- Asset::scripts('ready') --}}

  </body>
</html>
