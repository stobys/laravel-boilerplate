<h1>
	{{ $exception->getMessage() }}
</h1>
<br />
<h2>
	{{ $exception->getFile() }}:{{ $exception->getLine() }}
</h2>


<br /><br />Trace:
<pre>{{ $exception -> getTraceAsString() }}</pre>
