<div class="box-body">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#user-role-info" data-toggle="tab">
                    @lang('users-permissions.labels.model')
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="user-role-info">
                <div class="row">
                    <div class="col-md-6">
                        {{ html()->label( trans('users-permissions.model.name'), 'name')->class('control-label') }}
                        {{ html()->text('name')->class('form-control') }}

                        @if ( $errors->has('password') )
                            <p class="help-block">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>

                    <div class="col-md-6">
                            {{ html()->label( trans('users-permissions.model.name'), 'name')->class('col-sm-2 control-label') }}
                                {{ html() -> select()
                                            -> name('group_id')
                                            -> options($permissionsGroups)
                                            -> value($model->group_id)
                                            -> class('form-control select2able')
                                }}
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
