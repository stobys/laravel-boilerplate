<tr id="users-permissions-row-{{ $model->id }}">
    <td>
        {{ $model->name }}
    </td>
    <td>
        {{ optional($model->group)->code }}
    </td>
    <td class="text-center">
            @if ( ! $model->trashed() )
                <a href="{{ route('users-permissions-edit', [$model->id]) }}" class="btn btn-sm btn-primary tip" title="{{ trans('app.labels.edit') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </a>
            @endif

            @if ( $model->trashed() )
                <a href="{{ route('users-permissions-restore', [$model->id]) }}" class="btn btn-sm btn-danger tip" title="{{ trans('app.labels.restore') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @else
                <a href="{{ route('users-permissions-delete', [$model->id]) }}" class="btn btn-sm btn-danger tip" title="{{ trans('app.labels.delete') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @endif
    </td>
</tr>
