@extends('_layouts.backbone')

@section('body')
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
@endsection

@section('inline-scripts')
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
@endsection
