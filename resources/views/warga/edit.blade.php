<x-layouts.panel title="Edit Warga">

<div class="mx-auto max-w-3xl">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                Edit Warga
            </h1>
            <p class="mt-1 text-sm text-[#3C5A52]">
                Perbarui informasi dan data pendaftaran warga.
            </p>
        </div>

        <a href="{{ route('warga.index') }}" class="btn-secondary">
            &larr; Kembali
        </a>
    </div>

    <form method="POST"
          action="{{ route('warga.update', $warga) }}"
          class="rounded-2xl border border-[#DAF1DE] bg-white p-6 shadow-sm">

        @csrf
        @method('PUT')

        @include('warga._form', ['warga' => $warga])

        <div class="mt-8 flex justify-end gap-3 border-t border-[#DAF1DE] pt-5">
            <a href="{{ route('warga.show', $warga) }}" class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-primary">
                Simpan Perubahan
            </button>
        </div>

    </form>

</div>

</x-layouts.panel>