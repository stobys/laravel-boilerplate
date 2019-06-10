<input class="form-control {{ $class }}" id="{{ $id }}" id="{{ $name }}" placeholder="{{ $placeholder }}" type="{{ $type }}"
	@if( $attributes )
		@foreach($attributes as $key => $value)
			{{ $key }}="{{ $value }}"
		@endforeach
	@endif
/>


{{-- html()->text('title')->class('form-control') --}}
