<x-layouts.panel :title="isset($header) && is_string($header) ? $header : null">
    @isset($header)
        @if(!is_string($header))
            <div class="mb-6">
                {{ $header }}
            </div>
        @endif
    @endisset

    {{ $slot }}
</x-layouts.panel>

