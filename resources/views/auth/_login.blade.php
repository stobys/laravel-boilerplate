<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ env('APP_NAME') }} :: Login</title>

        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="csrf-token" content="<?= csrf_token() ?>">

        <link rel="stylesheet" href="{{ asset(mix('/assets/css/combined.css')) }}">

        <!--[if lt IE 9]>
            <script src="{{ asset(mix('/assets/js/combined-IE9.js')) }}"></script>
        <![endif]-->

        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>

    {{--
        SKINS  : skin-blue, skin-black, skin-purple, skin-yellow, skin-red, skin-green
        LAYOUT : fixed, layout-boxed, layout-top-nav, sidebar-collapse, sidebar-mini
    --}}
    <body class="hold-transition skin-blue-light sidebar-mini">
        <div class="wrapper">

            <div class="container-fluid">
                {{ html()->form('POST', route('login'))->class('form-horizontal')->open() }}
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="box box-info" style="margin-top:150px;">
                            <div class="box-header with-border">
                                <h3 class="text-center">
                                    App Logo Here - _login
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

                            </div>

                            <div class="box-footer text-center">
                                <button type="submit" class="btn btn-lg btn-labeled btn-success">
                                    <span class="btn-label">
                                        <i class="fa fa-lg fa-sign-in"></i>
                                    </span>
                                    @lang('app.actions.login')
                                </button>
                            </div>

                            @if ($errors->has('username'))
                            <div class="box-footer text-center">
                                <br />
                                <div class="alert alert-danger alert-dismissible text-left">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4 class="alert-heading">
                                        <i class="icon fa fa-ban"></i>
                                        {{ $errors->first('username') }}
                                    </h4>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>

            <script src="{{ asset( mix('/assets/js/login.js') ) }}"></script>
            <script type="text/javascript">

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

        </div>
    </body>
</html>
