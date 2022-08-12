<tfoot>
<tr>
    <td colspan="{{ $span }}" class="text-center adient-pagination">
        {!! $models->links() !!}
    </td>
    <td>
        <div class="input-group">
            <span class="input-group-addon">
                {{ trans('app.label.index-items-per-page') }} :
            </span>
            <select class="form-control input-sm pull-right">
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>

    </td>
</tr>
</tfoot>
