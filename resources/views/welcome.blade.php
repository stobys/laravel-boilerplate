@extends('_layouts.master')

@section('title', 'Home Page')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $counters['users'] }}</h3>
                <p>Users</p>
            </div>
            <div class="icon">
                @fa('user')

                @datetime(now())
            </div>
            <a href="{{ route('users-index') }}" class="small-box-footer">
                Users List <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $counters['roles'] }}</h3>
                <p>Roles</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="{{ route('users-roles-index') }}" class="small-box-footer">
                Roles List <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $counters['permissions'] }}</h3>
                <p>Permissions</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="{{ route('users-permissions-index') }}" class="small-box-footer">
                Permissions List <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>


@endsection
