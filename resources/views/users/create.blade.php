@extends('_layouts.master')

@section('title')
    @lang('users.labels.action-create')
@endsection

@section('content')
    <div class="box box-primary box-solid">

        <div class="box-header with-border">
            <h3 class="box-title">
                <strong>
                    @lang('users.labels.action-create')
                </strong>
            </h3>
        </div>

        {{ html()->form('POST', route('users-store'))->open() }}
            @include('users._form_create_edit')

        <div class="box-footer text-center">
            <button type="submit" class="btn btn-lg btn-labeled btn-success">
                <span class="btn-label">
                    <i class="fa fa-lg fa-save"></i>
                </span>
                {{ trans('app.actions.save') }}
            </button>
            <a href="{{ $model->action('index') }}" class="btn btn-lg btn-labeled btn-default">
                <span class="btn-label">
                    <i class="fa fa-lg fa-times"></i>
                </span>
                {{ trans('app.actions.cancel') }}
            </a>
        </div>

        {{ html()->form()->close() }}

    </div>
@endsection
