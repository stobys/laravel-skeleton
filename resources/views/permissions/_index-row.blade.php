<x-index-row :model="$model" id="{{ $model->id }}" preview edit delete restore>
    <td>
        {{ $model->name ?? '' }}
    </td>
    <td>
        {{ $model -> description() }}
    </td>
    <td>
        {{ $model -> group -> description() ?? '---' }}
    </td>
</x-index-row>
