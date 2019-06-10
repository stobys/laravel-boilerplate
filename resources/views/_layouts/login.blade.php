<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    {{-- Tell the browser to be responsive to screen width --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="<?= csrf_token() ?>">

    <link rel="shortcut icon" href="{{ asset('assets/adient-favicon.ico') }}" type="image/vnd.microsoft.icon" id="favicon" />

    <link rel="stylesheet" href="{{ asset( mix('/assets/css/styles.css') ) }}">

    {{-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --}}
    {{-- WARNING: Respond.js doesn't work if you view the page via file:// --}}
    <!--[if lt IE 9]>
        <script src="{{ asset( mix('/assets/js/ltIE9.js') ) }}"></script>
    <![endif]-->
    <script src="{{ asset( mix('/assets/js/scriptsHeader.js') ) }}"></script>

    {{ Asset::scripts('header') }}

</head>

<body>

    <div class="container-fluid">
        {{ html()->form('POST', route('login'))->class('form-horizontal')->open() }}
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-adient" style="margin-top:150px;">
                    <div class="box-header with-border">
                        <h3 class="text-center logo">
                            <img src="{{ asset('assets/img/adient-logo1.gif') }}" alt="Adient" />
                        </h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-lg fa-user"></i>
                                    </span>
                                    {{ html()->text('username', old('username'))->class('input-lg form-control')->placeholder(trans('app.username'))->attribute('autofocus')->attribute('tabIndex', 1) }}
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-fw fa-lg fa-lock"></i>
                                    </span>
                                    {{ html()->password('password')->class('input-lg form-control')->placeholder(trans('app.password'))->attribute('tabIndex', 2) }}
                                </div>
                            </div>
                        </div>
                        <br />

                        @if ($errors->has('username'))
                        <div class="row">
                            <div class="col-md-12 @if ($errors->has('username')) has-error @endif">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <i class="icon fa fa-ban"></i> {{ $errors->first('username') }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="box-footer text-center">
                        <div class="btn-group">
                            <button class="btn btn-lg btn-adient" type="submit" tabindex="3">
                                @lang('app.doLogin')
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>

    {{-- loading JS scripts --}}
    <script src="{{ asset( mix('/assets/js/scriptsFooter.js') ) }}"></script>

    <script type="text/javascript">
        var appBaseUrl = '{{ URL::to('/') }}/';
        var appLang = '{{ Lang::locale() }}';

        // myAPP.set('baseUrl', '{{ URL::to('/') }}/');
        // myAPP.set('lang', '{{ Lang::locale() }}');

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
    </script>

    {{ Asset::scripts('footer') }}
    {{ Asset::scripts('ready') }}

</body>
</html>
