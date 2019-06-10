<tr id="users-permission-group-row-{{ $model->id }}">
    <td>
        {{ $model->code }}
    </td>
    <td class="text-center">
            @if ( ! $model->trashed() )
                <a href="{{ route('users-permissions-groups-edit', [$model->id]) }}" class="btn btn-sm btn-primary tip" title="{{ trans('app.labels.edit') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </a>
            @endif

            @if ( $model->trashed() )
                <a href="{{ route('users-permissions-groups-restore', [$model->id]) }}" class="btn btn-sm btn-danger tip" title="{{ trans('app.labels.restore') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @else
                <a href="{{ route('users-permissions-groups-delete', [$model->id]) }}" class="btn btn-sm btn-danger tip" title="{{ trans('app.labels.delete') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @endif
    </td>
</tr>
