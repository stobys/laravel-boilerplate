<tr id="users-roles-row-{{ $model->id }}">
    <td>
        {{ $model->name }}
    </td>
    <td class="text-center">
            @if ( ! $model->trashed() )
                <a href="{{ route('users-roles-edit', [$model->id]) }}" class="btn btn-sm btn-primary tip" title="{{ trans('app.labels.edit') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-edit"></i>
                </a>
            @endif

            @if ( $model->trashed() )
                <a href="{{ route('users-roles-restore', [$model->id]) }}" class="btn btn-sm btn-danger tip" title="{{ trans('app.labels.restore') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @else
                <a href="{{ route('users-roles-delete', [$model->id]) }}" class="btn btn-sm btn-danger tip" title="{{ trans('app.labels.delete') }}"
                   data-toggle="tooltip" data-placement="top">
                    <i class="fa fa-trash-o"></i>
                </a>
            @endif
    </td>
</tr>
