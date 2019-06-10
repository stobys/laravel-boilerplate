<div class="box-body">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#user-overview" data-toggle="tab">
                    @lang('users.labels.overview')
                </a>
            </li>
        </ul>
        {{ $model->can('users-create') }}

        @can('users-index')
            can index
        @endcan

        @can('users-create')
            can create
        @endcan

        @can('users-edit')
            can edit
        @endcan


        <div class="tab-content">
            <div class="tab-pane active" id="user-overview">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('username')) has-error @endif">

                            {{ html()->label( trans('users.model.username'), 'username')->class('control-label') }}
                            @if( $model->loaded() )
                                {{ html()->text('username')->attribute('readonly', 'readonly')->class('form-control') }}
                            @else
                                {{ html()->text('username')->class('form-control') }}
                            @endif

                            @if ( $errors->has('username') )
                                <p class="help-block">
                                    {{ $errors->first('username') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('email')) has-error @endif">
                            {{ html()->label( trans('users.model.email'), 'email')->class('control-label') }}
                            {{ html()->text('email')->class('form-control') }}

                            @if ( $errors->has('email') )
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('password')) has-error @endif">
                            {{ html()->label( trans('users.model.password'), 'password')->class('control-label') }}
                            {{ html()->password('password')->value('')->class('form-control') }}

                            @if ( $errors->has('password') )
                                <p class="help-block">
                                    {{ $errors->first('password') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('first_name')) has-error @endif">
                            {{ html()->label( trans('users.model.first_name'), 'first_name')->class('control-label') }}
                            {{ html()->text('first_name')->class('form-control') }}

                            @if ( $errors->has('first_name') )
                                <p class="help-block">
                                    {{ $errors->first('first_name') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('last_name')) has-error @endif">
                            {{ html()->label( trans('users.model.last_name'), 'last_name')->class('control-label') }}
                            {{ html()->text('last_name')->class('form-control') }}

                            @if ( $errors->has('last_name') )
                                <p class="help-block">
                                    {{ $errors->first('last_name') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
                            {{ html()->label( trans('users.model.password_confirmation'), 'password_confirmation')->class('control-label') }}
                            {{ html()->password('password_confirmation')->value('')->class('form-control') }}

                            @if ( $errors->has('password_confirmation') )
                                <p class="help-block">
                                    {{ $errors->first('password_confirmation') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-8">
                        {{ $model->roles->pluck('id') }}
                        <div class="form-group @if ($errors->has('first_name')) has-error @endif">
                            {{ html()->label( trans('users.model.roles'), 'roles_id')->class('control-label') }}
                            {{ html() -> select()
                                -> name('roles_ids[]')
                                -> options($roles)
                                -> value($model->roles->pluck('id'))
                                -> class('form-control select2able')
                                -> attribute('multiple', 'multiple')
                            }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
