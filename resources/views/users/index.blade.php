@extends('_layouts.master')

@section('title')
    @lang('users.labels.action-index')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="nav-tabs-custom">

                @include('_partials.users_index_tabs')

                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            @include('users._form_filter')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-pane active">
                                <div class="box box-info">
                                    <div class="box-body table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                            <tr>
                                                <td></td>
                                                <td colspan="3">
                                                    <a href="{{ URL::route('users-create') }}" class="btn btn-sm btn-labeled btn-success">
                                                        <span class="btn-label">
                                                            <i class="fa fa-plus"></i>
                                                        </span>
                                                        {{ trans('users.labels.add-model') }}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if( request()->is('users/trash') )
                                                        <a href="#" data-js-action="bulkRestoreSubmit" class="btn btn-sm btn-success tip" title="{{ trans('app.actions.restore-selected') }}"
                                                           data-toggle="tooltip" data-placement="top">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" data-js-action="bulkDeleteSubmit" class="btn btn-sm btn-danger tip" title="{{ trans('app.actions.delete-selected') }}"
                                                           data-toggle="tooltip" data-placement="top">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr class="bg-light-blue-gradient">
                                                <th class="text-center" style="width:50px;">
                                                    {{ html()->checkbox()->id('testCheckbox')->attributes(
                                                        ['data-js-action' => 'toogleAllIndexItems']
                                                        ) }}
                                                </th>
                                                <th>{{ trans('users.model.username') }}</th>
                                                <th>{{ trans('users.model.email') }}</th>
                                                <th>{{ trans('users.model.last_login_at') }}</th>
                                                <th style="width:200px;">
                                                    {{ trans('app.labels.options') }}
                                                </th>
                                            </tr>
                                            </thead>

                                            @include('_forms._table_tfoot_paginator', ['span' => 4])

                                            <tbody class="text-vcenter">
                                                @if( request()->is('users/trash') )
                                                    {{ html()->form('POST', route('users-restore-bulk'))->id('bulk-restore')->open() }}
                                                @else
                                                    {{ html()->form('POST', route('users-delete-bulk'))->id('bulk-delete')->open() }}
                                                @endif

                                                @each('users.index-row', $models, 'model', 'users.empty-set')
                                                {{ html()->form()->close() }}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">


            </div>
        </div>

    </div>

@endsection
