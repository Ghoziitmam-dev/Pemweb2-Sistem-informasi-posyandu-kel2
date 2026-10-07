<x-layouts.panel title="Edit Warga">

@php
    $btn = 'inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-medium transition';
    $primary = $btn.' bg-emerald-600 text-white hover:bg-emerald-700';
    $ghost = $btn.' border border-slate-200 text-slate-600 hover:bg-slate-50';
@endphp

<div class="mx-auto max-w-3xl">

    <div class="mb-6 flex items-end justify-between">

        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Edit Warga
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Tinjau data warga.
            </p>
        </div>

        <a href="{{ route('warga.index') }}" class="{{ $ghost }}">
            &larr; Kembali
        </a>

    </div>

    <form method="POST"
          action="{{ route('warga.update', $warga) }}"
          class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

        @csrf
        @method('PUT')

        @include('warga._form', ['warga' => $warga])

        <div class="mt-6 flex justify-end gap-2 border-t border-slate-100 pt-5">

            <a href="{{ route('warga.show', $warga) }}" class="{{ $ghost }}">
                Batal
            </a>

            <button class="{{ $primary }}">
                Simpan Perubahan
            </button>

        </div>

    </form>

</div>

</x-layouts.panel>