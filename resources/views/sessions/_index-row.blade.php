@php
    $class = ($model->id == session()->getId()) ? 'bg-teal' : '';
@endphp

<x-index-row :model="$model" id="{{ $model->id }}" class="{{ $class }}" delete>
    <td>
            <img class="img-avatar img-circle elevation-2 mr-2" src="{{ route('users-avatar', $model->user?->id ?? 0) }}" alt="avatar" />
            {{ $model->user?->username ?? 'guest' }}
    </td>
    <td>
        {{ $model->ip_address ?? '' }}
    </td>
    <td>
        {{ $model->user_agent ?? '' }}
    </td>
    <td>
        {{ $model->last_activity ?? '' }}<br />
        <small>({{ $model->last_activity->diffForHumans() }})</small>
    </td>
</x-index-row>
