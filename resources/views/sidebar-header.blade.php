<div class="user-panel">
    <div class="pull-left image">
        <img src="{{ asset('/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{ optional(auth()->user())->full_name }}</p>
        <!-- Status -->
        <a href="#">
            <i class="fa fa-circle text-success"></i>
            It's tricky.
        </a>
    </div>
</div>

<!-- search form (Optional) -->
{{ html()->form('GET', route('search'))->class('sidebar-form')->open() }}
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search..." value="{{ session()->get('searchQueryString') }}">
        <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>
{{ html()->form()->close() }}
