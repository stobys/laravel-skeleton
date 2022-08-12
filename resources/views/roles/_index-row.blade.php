<x-index-row :model="$model" id="{{ $model->id }}" preview edit delete restore>
    <td>
        {{ $model->id ?? '' }}
    </td>
    <td>
        {{ $model->name ?? '' }}
    </td>
    <td>
		@foreach($model->permissions as $key => $item)
			<span class="badge badge-info" title="{{ $item -> name ?? '' }}">{{ $item -> description() }}</span>
		@endforeach
    </td>
</x-index-row>
