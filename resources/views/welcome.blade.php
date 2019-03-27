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
                <h3>5</h3>
                <p>Models In Database</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="{{ route('home') }}" class="small-box-footer">
                Open Authors List <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>14</h3>
                <p>Books In Database</p>
            </div>
            <div class="icon">
                <i class="fa fa-book"></i>
            </div>
            <a href="{{ route('home') }}" class="small-box-footer">
                Open Books List <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

@endsection
