<x-layouts.panel title="Tambah Warga">

<div class="mx-auto max-w-3xl">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                Tambah Warga
            </h1>
            <p class="mt-1 text-sm text-[#3C5A52]">
                Daftarkan warga baru ke sistem Posyandu.
            </p>
        </div>

        <a href="{{ route('warga.index') }}" class="btn-secondary">
            &larr; Kembali
        </a>
    </div>

    <form method="POST"
          action="{{ route('warga.store') }}"
          class="rounded-2xl border border-[#DAF1DE] bg-white p-6 shadow-sm">

        @csrf

        @include('warga._form', ['warga' => null])

        <div class="mt-8 flex justify-end gap-3 border-t border-[#DAF1DE] pt-5">
            <a href="{{ route('warga.index') }}" class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-primary">
                Simpan Warga
            </button>
        </div>

    </form>

</div>

</x-layouts.panel>