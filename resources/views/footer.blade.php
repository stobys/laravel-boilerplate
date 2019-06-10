<footer class="main-footer">
    <div class="pull-right hidden-xs">
    	<strong>
        &copy; {{ date('Y') }}
        /
        v{{ app()::VERSION }}
    	</strong>
    </div>

   	Rendered in {{ number_format((microtime(true) - LARAVEL_START), 4) }} seconds
</footer>
