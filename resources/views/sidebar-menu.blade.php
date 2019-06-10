<ul class="sidebar-menu" data-widget="tree">
	<li class="header">
		User Mgmt
	</li>
	<li class="treeview {{ controller('users', 'active') }}">
		<a href="#">
			<i class="fa fa-user"></i>
			<span>
				@lang('users.labels.models')
			</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ controller('users@index', 'active') }}">
				<a href="{{ route('users-index') }}" class="active">
					@lang('users.actions.index')
				</a>
			</li>
			<li class="{{ controller('users@create', 'active') }}">
				<a href="{{ route('users-create') }}">
					@lang('users.actions.create')
				</a>
			</li>
			<li class="{{ controller('users@trash', 'active') }}">
				<a href="{{ route('users-trash') }}">
					@lang('users.actions.trash')
				</a>
			</li>
		</ul>
	</li>
	<li class="treeview {{ controller('usersRoles', 'active') }}">
		<a href="#">
			<i class="fa fa-user"></i>
			<span>
				@lang('users-roles.labels.models')
			</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ controller('usersRoles@index', 'active') }}">
				<a href="{{ route('users-roles-index') }}" class="active">
					@lang('users-roles.actions.index')
				</a>
			</li>
			<li class="{{ controller('usersRoles@create', 'active') }}">
				<a href="{{ route('users-roles-create') }}">
					@lang('users-roles.actions.create')
				</a>
			</li>
			<li class="{{ controller('usersRoles@trash', 'active') }}">
				<a href="{{ route('users-roles-trash') }}">
					@lang('users-roles.actions.trash')
				</a>
			</li>
		</ul>
	</li>
	<li class="treeview {{ controller('usersPermissions', 'active') }}">
		<a href="#">
			<i class="fa fa-user"></i>
			<span>
				@lang('users-permissions.labels.models')
			</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ controller('usersPermissions@index', 'active') }}">
				<a href="{{ route('users-permissions-index') }}" class="active">
					@lang('users-permissions.actions.index')
				</a>
			</li>
			<li class="{{ controller('usersPermissions@create', 'active') }}">
				<a href="{{ route('users-permissions-create') }}">
					@lang('users-permissions.actions.create')
				</a>
			</li>
			<li class="{{ controller('usersPermissions@trash', 'active') }}">
				<a href="{{ route('users-permissions-trash') }}">
					@lang('users-permissions.actions.trash')
				</a>
			</li>
		</ul>
	</li>
	<li class="treeview {{ controller('usersPermissionsGroups', 'active') }}">
		<a href="#">
			<i class="fa fa-user"></i>
			<span>
				@lang('users-permissions-groups.labels.models')
			</span>
		<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li class="{{ controller('usersPermissionsGroups@index', 'active') }}">
				<a href="{{ route('users-permissions-groups-index') }}" class="active">
					@lang('users-permissions-groups.actions.index')
				</a>
			</li>
			<li class="{{ controller('usersPermissionsGroups@create', 'active') }}">
				<a href="{{ route('users-permissions-groups-create') }}">
					@lang('users-permissions-groups.actions.create')
				</a>
			</li>
			<li class="{{ controller('usersPermissionsGroups@trash', 'active') }}">
				<a href="{{ route('users-permissions-groups-trash') }}">
					@lang('users-permissions-groups.actions.trash')
				</a>
			</li>
		</ul>
	</li>

</ul>
