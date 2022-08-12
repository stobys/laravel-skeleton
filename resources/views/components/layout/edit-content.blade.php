@props([
    'controller'    => controllerName(),
    'model'         => null,
    'modelId'       => null,
    'route'         => controllerRoute('update'),
    'buttons'       => ['save', 'cancel'],
])

@php
    $model_id = $modelId ?? $model -> getRouteKey();
@endphp

<div {{ $attributes->merge(['class' => "card card-adient-teal card-outline"]) }}>
    <x-form id="actionForm" action="{{ route($route, $model_id) }}" method="PATCH">
        <div class="card-body">
            {{ $slot }}
        </div>
        
        <div class="card-footer text-center">
            @includeIf('layouts._module-action-buttons', [
                'buttons' => $buttons,
                'action' => 'edit'
            ])
        </div>
    </x-form>
</div>
