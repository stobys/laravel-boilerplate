<tr id="users-row-{{ $model -> id }}">
    <td class="text-center">
        {{
            html() -> checkbox('selected_rows['. $model->id .']')
                    -> id('select_row_'. $model->id)
                    -> value('1')
        }}
    </td>
    <td>
        {{ $model -> full_name }}
        <br />
        ({{ $model -> username }})
    </td>
    <td>
        {{ $model -> email }}
    </td>
    <td>
        {{ optional($model -> last_login_at) -> format('Y-m-d H:i') }}
    </td>
    <td class="text-center">
        <div class="btn-group2">
            <a href="{{ route('users-show', [$model->id]) }}" class="btn btn-sm btn-primary tip" title="{{ trans('app.actions.show') }}"
               data-toggle="tooltip" data-placement="top">
                <i class="fa fa-file-text-o"></i>
            </a>
            <a href="{{ route('users-edit', [$model->id]) }}" class="btn btn-sm btn-primary tip" title="{{ trans('app.actions.edit') }}"
               data-toggle="tooltip" data-placement="top">
                <i class="fa fa-edit"></i>
            </a>
            @if( $model -> trashed() )
                <a href="{{ route('users-restore', [$model->id]) }}" class="btn btn-sm btn-success tip" title="{{ trans('app.actions.restore') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @else
                <a href="{{ route('users-delete', [$model->id]) }}" class="btn btn-sm btn-danger tip" title="{{ trans('app.actions.delete') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @endif
        </div>
    </td>
</tr>
