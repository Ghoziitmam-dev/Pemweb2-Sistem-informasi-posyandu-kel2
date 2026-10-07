<x-layouts.panel title="Edit Pemeriksaan">

<div class="mx-auto max-w-4xl">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                Edit Pemeriksaan
            </h1>
            <p class="mt-1 text-sm text-[#3C5A52]">
                Perbarui hasil pengukuran dan rekam medis pemeriksaan.
            </p>
        </div>

        <a href="{{ route('pemeriksaan.index') }}" class="btn-secondary">
            &larr; Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 p-4 text-sm font-semibold text-rose-800 shadow-2xs">
            <p class="font-bold">Terdapat kesalahan pengisian:</p>
            <ul class="mt-2 list-inside list-disc font-medium text-rose-700">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemeriksaan.update', $pemeriksaan) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @include('pemeriksaan._form')

        <div class="flex justify-end gap-3 rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
            <a href="{{ route('pemeriksaan.index') }}" class="btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </form>

</div>

</x-layouts.panel>