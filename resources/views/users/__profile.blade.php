@extends('_layouts.master')

@section('title')
    @lang('users.labels.action-profile')
@endsection

@section('content')

    <div class="row">
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ asset('img/user7-128x128.jpg') }}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{ $model->full_name }}</h3>
                    <h5 class="widget-user-desc">{{ $model->title }}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#">
                                Projects <span class="pull-right badge bg-blue">31</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Tasks <span class="pull-right badge bg-aqua">5</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Completed Projects <span class="pull-right badge bg-green">12</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Followers <span class="pull-right badge bg-red">842</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username">{{ $model -> full_name }}</h3>
                    <h5 class="widget-user-desc">{{ $model -> title }}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('img/user1-128x128.jpg') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">3,200</h5>
                                <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">13,000</h5>
                                <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">35</h5>
                                <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url({{ asset('img/photo1.png') }}) center center;">
                    <h3 class="widget-user-username">{{ $model -> full_name }}</h3>
                    <h5 class="widget-user-desc">{{ $model -> title }}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('img/user3-128x128.jpg') }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">3,200</h5>
                                <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">13,000</h5>
                                <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">35</h5>
                                <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <!-- /.col -->
    </div>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">
                <strong>
                    {{ trans('users.label.user') }}: {{ $model->full_name }}
                    ({{ $model->username }})
                </strong>
            </h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('users.model.fullname') }}
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $model->full_name }}" type="text" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('users.model.fullname') }}
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $model->full_name }}" type="text" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('users.model.title') }}
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $model->title }}" type="text" disabled="disabled">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('users.model.username') }}
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $model->username }}" type="text" disabled="disabled">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('users.model.email') }}
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ $model->email }}" type="text" disabled="disabled">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">
                                {{ trans('users.model.last_login_at') }}
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" value="{{ optional($model->last_login_at)->toDateTimeString() }}" type="text" disabled="disabled">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer btn-group">
                <a href="{{ url()->previous() }}" class="btn btn-default">
                    <i class="fa fa-fw fa-chevron-left"></i>
                    {{ trans('app.tip.go-back') }}
                </a>

                <a href="{{ route('users-edit', [$model->id]) }}" class="btn btn-default">
                    <i class="fa fa-fw fa-edit"></i>
                    {{ trans('app.tip.edit') }}
                </a>

                @if( ! user()->isRoot() )
                    @if( $model->trashed() )
                        <a href="{{ route('users-restore', [$model->id]) }}" class="btn btn-default">
                            <i class="fa fa-fw fa-trash-o"></i>
                            {{ trans('app.tip.restore') }}
                        </a>
                    @else
                        <a href="{{ route('users-delete', [$model->id]) }}" class="btn btn-default">
                            <i class="fa fa-fw fa-trash-o"></i>
                            {{ trans('app.tip.delete') }}
                        </a>
                    @endif
                @endif
            </div>
        </form>
    </div>

@endsection
