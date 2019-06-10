@extends('_layouts.master')

@section('title')
    @lang('users.labels.action-show')
@endsection

@section('content')
    <div class="box box-primary box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">
                <strong>
                    @lang('users.labels.action-show') :: {{ $model->username }}
                </strong>
            </h3>
        </div>

        {{ html()->modelForm($model, 'GET', route('users-show', $model->id))->class('form-horizontal')->open() }}

            <div class="box-body">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#user-overview" data-toggle="tab">
                                @lang('users.labels.overview')
                            </a>
                        </li>
                        <li>
                            <a href="#user-privileges" data-toggle="tab">
                                @lang('users.labels.privileges')
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="user-overview">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{
                                            html() -> label( trans('users.model.username'), 'username')
                                                    -> class('control-label col-sm-3')
                                        }}
                                        <div class="col-sm-9">
                                            {{
                                                html() -> text('username') -> class('form-control')
                                                        -> attribute('readonly', 'readonly')
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{
                                            html() -> label( trans('users.model.email'), 'email')
                                                    -> class('control-label col-sm-3')
                                        }}
                                        <div class="col-sm-9">
                                            {{
                                                html() -> text('email') -> class('form-control')
                                                        -> attribute('readonly', 'readonly')
                                            }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{
                                            html() -> label( trans('users.model.last_login_at'), 'last_login_at')
                                                    -> class('control-label col-sm-3')
                                        }}
                                        <div class="col-sm-9">
                                            {{
                                                html() -> text('last_login_at') -> class('form-control')
                                                        -> attribute('readonly', 'readonly')
                                                        -> value( $model->last_login_at )
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{
                                            html() -> label( trans('users.model.full_name'), 'full_name')
                                                    -> class('control-label col-sm-3')
                                        }}
                                        <div class="col-sm-9">
                                            {{
                                                html() -> text('full_name') -> class('form-control')
                                                        -> attribute('readonly', 'readonly')
                                                        -> value($model->full_name)
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="user-privileges">
                            privileges table
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-footer text-center">
                <a href="{{ route('users-edit', $model->id) }}" class="btn btn-lg btn-labeled btn-default">
                    <span class="btn-label">
                        <i class="fa fa-lg fa-edit"></i>
                    </span>
                    {{ trans('app.actions.edit') }}
                </a>
                <a href="{{ route('users-index') }}" class="btn btn-lg btn-labeled btn-default">
                    <span class="btn-label">
                        <i class="fa fa-lg fa-times"></i>
                    </span>
                    {{ trans('app.actions.cancel') }}
                </a>
            </div>
        {{ html()->form()->close() }}
    </div>
@endsection
