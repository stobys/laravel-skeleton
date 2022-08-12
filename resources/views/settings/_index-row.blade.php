<x-index-row :model="$model" id="{{ $model->id }}" preview edit delete restore>
    <td>
        <img class="img-avatar img-circle elevation-2 mr-2" src="{{ route('users-avatar', $model->id) }}" alt="avatar" />
        {{ $model->username ?? '' }}
    </td>
    <td>
        {{ $model->email ?? '' }}
    </td>
    <td>
        {{ $model->family_name ?? '' }}
    </td>
    <td>
        {{ $model->given_name ?? '' }}
    </td>
    <td>
        @foreach($model->roles as $key => $item)
            <span class="badge badge-info">{{ $item->name }}</span>
        @endforeach
    </td>

    {{-- 
    <x-slot name="buttonsPrepend">
        @if ( auth()->user()->can('users.password-change') || auth()->user()->isSuperAdmin() )
        <a href="{{ route('change-user-password', $model->id) }}" class="btn btn-link tip" title="{{ __('users.actions.change-password') }}"
            data-toggle="tooltip" data-placement="top">
            <x-icon icon="key" fw />
        </a>
        @endif

        @if ( config('system.allow-impersonations') && auth()->user()->canImpersonate() && $model -> canBeImpersonated() )
            <a href="{{ route('impersonate', $model->id) }}" class="btn btn-link tip" title="{{ __('users.actions.impersonate') }}" data-toggle="tooltip"
                data-placement="top">
                <x-icon icon="people-arrows" fw />
            </a>
        @endif
    </x-slot>
    --}}

</x-index-row>
