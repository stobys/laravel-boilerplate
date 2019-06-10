@extends('skel')

@section('content')
    <div class="box box-primary">
    	{{ html()->modelForm($model, 'PATCH', route('users-do-change-password', $model->id))->class('form-horizontal')->open() }}

		<div class="box-body">
			@if( $selfPasswordChange )
		    <div class="row">
		        <div class="col-md-offset-2 col-md-6">
		            <div class="form-group @if ($errors->has('old_password')) has-error @endif">
		            	{{ html()->label(trans('users.model.old_password'))->class('col-sm-4 control-label') }}
		                <div class="col-sm-8">
		                	{{ html()->password('old_password')->class('form-control') }}

		                    @if ( $errors->has('old_password') )
		                        <p class="help-block">{{ $errors->first('old_password') }}</p>
		                    @endif
		                </div>
		            </div>
		        </div>
		    </div>
		    @endif

		    <div class="row">
		        <div class="col-md-offset-2 col-md-6">
		            <div class="form-group @if ($errors->has('new_password')) has-error @endif">
		            	{{ html()->label(trans('users.model.new_password'))->class('col-sm-4 control-label') }}
		                <div class="col-sm-8">
		                	{{ html()->password('new_password')->class('form-control') }}

		                    @if ( $errors->has('new_password') )
		                        <p class="help-block">{{ $errors->first('new_password') }}</p>
		                    @endif
		                </div>
		            </div>
		        </div>
		    </div>

		    <div class="row">
		        <div class="col-md-offset-2 col-md-6">
		            <div class="form-group @if ($errors->has('new_password_confirmation')) has-error @endif">
		            	{{ html()->label(trans('users.model.new_password_confirmation'))->class('col-sm-4 control-label') }}
		                <div class="col-sm-8">
		                	{{ html()->password('new_password_confirmation')->class('form-control') }}

		                    @if ( $errors->has('new_password_confirmation') )
		                        <p class="help-block">{{ $errors->first('new_password_confirmation') }}</p>
		                    @endif
		                </div>
		            </div>
		        </div>
		    </div>
		</div>


        <div class="box-footer text-center">
            <div class="btn-group">
            	{{ html()->submit(trans('app.form.save'))->class('btn btn-lg btn-success') }}
            	{{ html()->a(route('users-index'), trans('app.form.cancel'))->class('btn btn-lg btn-default') }}
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
@endsection
