<ul class="nav nav-tabs">
    <li class="{{ controller('users@index', 'active') }}">
        <a href="{{ route('users-index') }}">
            {{ trans('users.labels.models') }}
        </a>
    </li>
    <li class="{{ controller('usersRoles@index', 'active') }}">
        <a href="{{ route('users-roles-index') }}">
            {{ trans('users-roles.labels.models') }}
        </a>
    </li>
    <li class="{{ controller('usersPermissions@index', 'active') }}">
        <a href="{{ route('users-permissions-index') }}">
            {{ trans('users-permissions.labels.models') }}
        </a>
    </li>
    <li class="{{ controller('usersPermissionsGroups@index', 'active') }}">
        <a href="{{ route('users-permissions-groups-index') }}">
            {{ trans('users-permissions-groups.labels.models') }}
        </a>
    </li>
    <li class="dropdown pull-right {!! controller('@trash', 'active') !!}">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fa fa-fw fa-lg fa-trash-o"></i>
            @lang('app.labels.trash') (
				{{ controller('users', trans('users.labels.models')) }}
	            {{ controller('usersRoles', trans('users-roles.labels.models')) }}
	            {{ controller('usersPermissions', trans('users-permissions.labels.models')) }}
	            {{ controller('usersPermissionsGroups', trans('users-permissions-groups.labels.models')) }}
            )
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation" class="text-right">
                <a class="text-right" role="menuitem" tabindex="-1" href="{{ route('users-trash') }}">
                    @lang('users.labels.models')
                </a>
            </li>
            <li role="presentation" class="text-right">
                <a class="text-right" role="menuitem" tabindex="-1" href="{{ route('users-roles-trash') }}">
                    @lang('users-roles.labels.models')
                </a>
            </li>
            <li role="presentation" class="text-right">
                <a class="text-right" role="menuitem" tabindex="-1" href="{{ route('users-permissions-trash') }}">
                    @lang('users-permissions.labels.models')
                </a>
            </li>
            <li role="presentation" class="text-right">
                <a class="text-right" role="menuitem" tabindex="-1" href="{{ route('users-permissions-groups-trash') }}">
                    @lang('users-permissions-groups.labels.models')
                </a>
            </li>
        </ul>
    </li>
</ul>
