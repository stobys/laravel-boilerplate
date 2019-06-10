@extends('_layouts.master')

@section('title')
    @lang('users-roles.labels.action-index')
@endsection

@section('content')
    <div class="box box-primary box-solid">
        <div class="box-header with-border">
            <h3 class="box-title">
                 @lang('users-permissions.labels.action-edit')
            </h3>
        </div>

        {{ html()->modelForm($model, 'PATCH', route('users-permissions-update', $model->id))->open() }}

            @include('users.permissions._form_create_edit')

        <div class="box-footer text-center">
            <button type="submit" class="btn btn-lg btn-labeled btn-success">
                <span class="btn-label">
                    <i class="fa fa-lg fa-save"></i>
                </span>
                @lang('app.actions.save')
            </button>
            <a href="{{ URL::route('users-permissions-index') }}" class="btn btn-lg btn-labeled btn-default">
                <span class="btn-label">
                    <i class="fa fa-lg fa-times"></i>
                </span>
                @lang('app.actions.cancel')
            </a>
        </div>
        {{ html()->form()->close() }}
    </div>
@endsection
