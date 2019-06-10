<div class="box-body">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#user-role-info" data-toggle="tab">
                    @lang('users-permissions-groups.labels.model')
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="user-role-info">
                <div class="row">
                    <div class="col-md-6">
                        {{ html()->label( trans('users-permissions-groups.model.code'), 'code')->class('control-label') }}
                        {{ html()->text('code')->class('form-control') }}

                        @if ( $errors->has('password') )
                            <p class="help-block">
                                {{ $errors->first('password') }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
