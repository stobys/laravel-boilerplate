<div class="box-body">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#user-role-info" data-toggle="tab">
                    @lang('users-roles.labels.model')
                </a>
            </li>
            <li>
                <a href="#user-role-permissions" data-toggle="tab">
                    @lang('users-roles.labels.permissions')
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="user-role-info">
                <div class="row">
                    <div class="col-md-6">
                        {{ html()->label( trans('users-roles.model.name'), 'name')->class('control-label') }}
                        {{ html()->text('name')->class('form-control') }}

                        @if ( $errors->has('password') )
                            <p class="help-block">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="user-role-permissions">
                <div class="row">
                    @foreach($permissionsGroups as $group)
                    <div class="col-md-3">
                        <div class="box box-solid box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">
                                    <label for="group_{{ $group->id }}">
                                        @lang('permissions.labels.'. $group -> code)
                                    </label>
                                </h3>

                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <div class="box-body">
                                @foreach($group->permissions as $permission)
                                    <div class="checkbox">
                                        <label for="permission_{{ $permission->id }}">
                                            <input type="checkbox" id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" data-toggle="toggle" data-size="small" data-onstyle="success" data-offstyle="default" data-on="@lang('app.yes')" data-off="@lang('app.no')"
                                               @if( $model->hasPermissionTo($permission) )
                                                   checked="checked"
                                               @endif
                                            />
                                            @lang('permissions.'. $permission->name)
                                        </label>
                                    </div>
                                    {{--
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <input type="checkbox" value="1" id="permission_{{ $permission->id }}" data-toggle="toggle"
                                                   data-on-color="success" data-off-color="warning"
                                                   data-on-text="@lang('app.yes')" data-off-text="@lang('app.no')" data-size="small"
                                            />
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="permission_{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                    --}}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


</div>
