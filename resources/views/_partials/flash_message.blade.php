
@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="callout callout-{{ $message['level'] }} callout-dismissible
            {{ $message['important'] ? 'callout-important' : '' }}
        ">
            <button type="button" class="close" data-dismiss="callout" aria-hidden="true">
                <i class="fa fa-times"></i>
            </button>
            @if ($message['title'])
            <h4>
                <i class="icon fa fa-ban"></i>
                {{ $message['title'] }}
            </h4>
            @endif

            <p>
                {!! $message['message'] !!}
            </p>
        </div>


        <div class="alert alert-{{ $message['level'] }} alert-dismissible
            {{ $message['important'] ? 'callout-important' : '' }}"
        ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                <i class="fa fa-times"></i>
            </button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>

            <p>
                {!! $message['message'] !!}
            </p>
        </div>




        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}




