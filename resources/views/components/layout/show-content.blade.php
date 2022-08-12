@props([
    'controller'    => controllerName(),
    'model'         => null,
    'modelId'       => null,
    'route'         => controllerRoute('index'),
    'buttons'       => ['cancel'],
])

@php
    $model_id = $modelId ?? $model -> number;
@endphp

<div {{ $attributes->merge(['class' => "card card-adient-teal card-outline"]) }}>
    <x-form id="actionForm" action="{{ route($route, $model_id) }}" method="GET">
        <div class="card-body">
            {{ $slot }}
        </div>
        
        <div class="card-footer text-center">
            @includeIf('layouts._module-action-buttons', [
                'buttons' => $buttons,
                'action' => 'show'
            ])
        </div>
    </x-form>
</div>
