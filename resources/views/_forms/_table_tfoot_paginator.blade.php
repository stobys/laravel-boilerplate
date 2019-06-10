@if( $models->count() )
<tfoot>
<tr>
    <td colspan="{{ $span }}" class="text-center">
        {!! $models->links() !!}
    </td>
    <td>
        <form method="GET" action="{{ route('alter-page-size') }}" onchange="this.submit();">
            <div class="input-group" style="margin:25px 0;">
                    <span class="input-group-addon">
                        @lang('app.labels.index-items-per-page') :
                    </span>
                    <select name="items-per-page" class="form-control input-sm">
                        <option value="5" @if(index_page_size(5)) selected="selected" @endif>5</option>
                        <option value="10" @if(index_page_size(10)) selected="selected" @endif>10</option>
                        <option value="15" @if(index_page_size(15)) selected="selected" @endif>15</option>
                        <option value="20" @if(index_page_size(20)) selected="selected" @endif>20</option>
                        <option value="25" @if(index_page_size(25)) selected="selected" @endif>25</option>
                        <option value="50" @if(index_page_size(50)) selected="selected" @endif>50</option>
                        <option value="100" @if(index_page_size(100)) selected="selected" @endif>100</option>
                    </select>
            </div>
        </form>
    </td>
</tr>
</tfoot>
@endif
