@extends('_layouts.master')

@section('title', 'Search Results')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')

	<div class="box box-success box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Search Results</h3>
		</div>

		<div class="box-body">
			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#found-authors" data-toggle="tab">
							@lang('authors.labels.models')
						</a>
					</li>
					<li>
						<a href="#found-books" data-toggle="tab">
							@lang('books.labels.models')
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="found-authors">
						@include('search-authors', compact('authors'))
					</div>

					<div class="tab-pane" id="found-books">
						@include('search-books', compact('books'))
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
