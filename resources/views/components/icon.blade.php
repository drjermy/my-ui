@props([
    'icon',
    'weight' => 'regular',
    'sr' => null,
    'fw' => null,
])

@php
    use MyUi\Support\Attr;

    $boolAttributesList = [
        'weight' => ['light', 'regular', 'duotone']
    ];

    foreach($boolAttributesList as $variableName => $boolAttributes) {
        foreach ($boolAttributes as $boolAttribute) {
            if (isset($attributes[$boolAttribute])) {
                $$variableName = $boolAttribute;
            }
            unset($attributes[$boolAttribute]);
        }
    }

    $iconClass = (new Attr())
        ->add("fa-$weight")
        ->add("fa-$icon")
        ->add('fa-fw', isset($fw));
@endphp

<span {{ $attributes }}>
    @isset ($sr)
        <span class="sr-only">{{ $sr }}</span>
    @endisset
    <i class="{{ $iconClass }}"></i>
</span>