@extends('_layouts.master')

@section('title')
    @lang('users.roles.labels.action-index')
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="nav-tabs-custom">

                @include('_partials.users_index_tabs')

                <div class="tab-content">
                    <div class="row">
                        <div class="col-md-12">
                            @include('users.roles._form_filter')
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-pane active">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">
                                            <a href="{{ route('users-permissions-groups-create') }}" class="btn btn-sm btn-labeled btn-success">
                                                <span class="btn-label">
                                                    <i class="fa fa-plus"></i>
                                                </span>
                                                {{ trans('users-permissions-groups.labels.add-model') }}
                                            </a>
                                        </h3>
                                        <div class="box-tools"></div>
                                    </div>

                                    <div class="box-body table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                            <tr class="bg-light-blue-gradient">
                                                <th>{{ trans('users-permissions-groups.model.name') }}</th>
                                                <th style="width:200px;">
                                                    {{ trans('app.labels.options') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            @include('_forms._table_tfoot_paginator', ['span' => 1])

                                            <tbody class="text-vcenter">
                                                @each('users.permissions-groups.index-row', $models, 'model', 'users.permissions-groups.empty-set')
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
