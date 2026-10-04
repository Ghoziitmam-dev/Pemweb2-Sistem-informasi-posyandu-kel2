@php
    $warna = match ($status) {
        'akan_datang' => 'bg-blue-100 text-blue-700',
        'berlangsung' => 'bg-green-100 text-green-700',
        'selesai' => 'bg-gray-100 text-gray-700',
        'batal' => 'bg-red-100 text-red-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp
<span class="px-2 py-1 text-xs font-semibold rounded-full {{ $warna }}">
    {{ $label }}
</span>