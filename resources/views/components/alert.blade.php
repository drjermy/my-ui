@props([
    'type' => 'warning', // success, info, warning, error
    'title' => null,
    'dismissable' => false,
    'accent' => false,
    'iconless' => false,
    'icon' => '',
    'message' => null,
    'weight' => 'regular',
    'visible' => true,
])

@php
    $colours = [
        'base' => [
            'success' => 'border-green-400',
            'info' => 'border-blue-400',
            'warning' => 'border-yellow-400',
            'error' => 'border-red-400',
        ],
        'alert' => [
            'success' => 'bg-green-50',
            'info' => 'bg-blue-50',
            'warning' => 'bg-yellow-50',
            'error' => 'bg-red-50',
        ],
        'icon' => [
            'success' => 'text-green-500',
            'info' => 'text-blue-500',
            'warning' => 'text-yellow-400',
            'error' => 'text-red-500',
        ],
        'message' => [
            'success' => 'text-green-700',
            'info' => 'text-blue-700',
            'warning' => 'text-yellow-700',
            'error' => 'text-red-700',
        ]
    ];

    $icons = [
        'success' => 'shield-check',
        'info' => 'circle-info',
        'warning' => 'triangle-exclamation',
        'error' => 'circle-xmark',
    ];

    $baseAlertCSS = 'rounded-md p-4';
    $borderAlertCSS = $accent ? 'border-l-4' : '';
    $accentAlertCSS = $colours['base'][$type] ?? '';
    $backgroundAlertCSS = $colours['alert'][$type] ?? '';
    $alertCSS = "$baseAlertCSS $borderAlertCSS $accentAlertCSS $backgroundAlertCSS";

    $iconCSS = $colours['icon'][$type] ?? '';

    $baseMessageCSS = 'text-sm';
    $titleMessageCSS = $title ? 'mt-2' : '';
    $textMessageCSS = $colours['message'][$type] ?? '';;

    $messageCSS = "$baseMessageCSS $titleMessageCSS $textMessageCSS";

    if (!$iconless) {
        $icon = $icon ?: $icons[$type];
    }

    if (isset($message)) {
        $slot = $message;
    }

@endphp

<div>
    @if ($visible)
    <div x-data="{ showAlert: true }">
        <div
            x-show="showAlert"
            x-transition
            {{ $attributes->merge(['class' => $alertCSS]) }}>

            <div class="flex items-center">
                <div class="flex-shrink-0">
                    @if ($icon)
                        <x-ui::icon :icon="$icon" :weight="$weight" :class="$iconCSS" />
                    @endif
                </div>
                <div class="ml-3">
                    <div class="{{ $messageCSS }}">
                        <p>{{ $slot }}</p>
                    </div>
                </div>

                @if ($dismissable)
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button
                                    @click="showAlert=false"
                                    type="button"
                                    class="{{ $messageCSS }} inline-flex rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2">

                                <x-ui::icon icon="times" sr="Dismiss" class="h-4 w-4 flex items-center justify-center" />

                            </button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    @endif
</div>