<x-index-row :model="$model" id="{{ $model->id }}" preview edit delete restore>
    <td>
        <img class="img-avatar img-circle elevation-2 mr-2" src="{{ route('users-avatar', $model->id) }}" alt="avatar" />
        {{ $model->username ?? '' }}
        @if( $model->personal_no )
            ({{ $model->personal_no }})
        @endif
    </td>
    <td>
        {{ $model->given_name ?? '' }}
    </td>
    <td>
        {{ $model->family_name ?? '' }}
    </td>
    <td>
        {{ $model->email ?? '' }}
    </td>
    <td>
        @foreach($model->roles as $key => $item)
            <span class="badge badge-info">{{ $item->name }}</span>
        @endforeach
    </td>
    <x-slot name="buttonsPrepend">
        @if ( $model->canAny(['inventoryscanner.scan', 'inventories.show']) && ! is_null($model->personal_no) )
        <a href="{{ route('users-badge', $model->id) }}" class="btn btn-link tip"
            title="{{ __('users.actions.print-badge') }}" data-toggle="tooltip" data-placement="top">
            <x-icon icon="id-card-clip" fw />
        </a>
        @endif

        {{--
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
        --}}

    </x-slot>

    <x-slot name="buttonsAppend">
        @if( auth()->user()->isSuperAdmin() && $model->versions?->count() )
            <a href="{{ route('user-versions', $model) }}" class="btn btn-link tip" title="{{ __('users.actions.show-versions') }}"
                data-toggle="tooltip" data-placement="top">
                <x-icon icon="code-compare" class="text-warning" fw />
            </a>
        @endif
    </x-slot>
</x-index-row>
