@extends('_layouts.backbone')

@section('title')
    Login Form
@endsection

@section('body')

            <div class="container-fluid">
                {{ html()->form('POST', route('login'))->class('form-horizontal')->open() }}
                <div class="row">

                    <div class="col-md-6 col-md-offset-3">
                        <div class="box box-info" style="margin-top:100px;">
                            <div class="box-header with-border">
                                <h3 class="text-center">
                                    <img src="{{ asset('img/sylvek-org-logo.png') }}" alt="SylveK.org" />
                                </h3>
                            </div>
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="{{ controller('login', 'active') }}">
                                                    <a href="{{ route('login') }}">
                                                        Login
                                                    </a>
                                                </li>
                                                <li class="pull-right">
                                                    <a href="{{ route('register') }}">
                                                        {{ __('Register') }}
                                                    </a>
                                                </li>
                                                <li class="pull-right">
                                                    <a href="{{ route('password-reset') }}">
                                                        Reset Password
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

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
@endsection

@section('foot-scripts')
    <script src="{{ asset( mix('/assets/js/login.js') ) }}"></script>
@endsection
