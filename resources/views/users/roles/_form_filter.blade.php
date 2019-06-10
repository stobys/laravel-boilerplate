<div class="box box-warning @if ( ! session('usersRolesFiltered') ) collapsed-box @endif">
    {{ html()->form()->open() }}

        @include('_forms._form_filter_box_header', ['module' => 'users-roles'])

        <div class="box-body">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ html()->label(trans('users-roles.model.username'))->for('username') }}

                            <div class="input-group">
                                {{ html()->text('username')->value(session('usersUsername'))->class('form-control') }}
                                <div class="input-group-addon clickable" data-js-action="clearInputGroupField">
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ html()->label(trans('users.model.name'))->for('name') }}

                            <div class="input-group">
                                {{ html()->text('name')->value(session('usersName'))->class('form-control') }}
                                <div class="input-group-addon clickable" data-js-action="clearInputGroupField">
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            {{ html()->label(trans('users.model.email'))->for('email') }}

                            <div class="input-group">
                                {{ html()->text('email')->value(session('usersEmail'))->class('form-control') }}
                                <div class="input-group-addon clickable" data-js-action="clearInputGroupField">
                                    <i class="fa fa-times"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            @include('_forms._form_filter_box_footer', ['module' => 'users'])

        </div>
    {{ html()->form()->close() }}
</div>
