<x-layouts.panel title="Tambah Pemeriksaan">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

    <style>
        .ts-control {
            border-radius: 0.75rem !important;
            border-color: #BCDCC6 !important;
            padding: 0.625rem 0.875rem !important;
            font-size: 0.875rem !important;
            box-shadow: none !important;
        }
        .ts-control.focus {
            border-color: #235347 !important;
            ring: 1px #235347 !important;
        }
        .ts-dropdown {
            border-radius: 0.75rem !important;
            border-color: #BCDCC6 !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        }
    </style>

    <div class="mx-auto max-w-4xl">

        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                    Tambah Pemeriksaan
                </h1>
                <p class="mt-1 text-sm text-[#3C5A52]">
                    Catat hasil pengukuran fisik dan kondisi kesehatan warga.
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

        <form action="{{ route('pemeriksaan.store') }}" method="POST" class="space-y-6">
            @csrf

            @include('pemeriksaan._form')

            <div class="flex justify-end gap-3 rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
                <a href="{{ route('pemeriksaan.index') }}" class="btn-secondary">
                    Batal
                </a>

                <button type="submit" class="btn-primary">
                    Simpan Pemeriksaan
                </button>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const config = {
                create: false,
                allowEmptyOption: true,
                maxOptions: 100,
                closeAfterSelect: true
            };

            if(document.getElementById('warga_id')) {
                new TomSelect('#warga_id', { ...config, placeholder: 'Cari nama atau NIK warga...' });
            }
            if(document.getElementById('jadwal_id')) {
                new TomSelect('#jadwal_id', { ...config, placeholder: 'Cari tanggal atau lokasi jadwal...' });
            }
            if(document.getElementById('pemeriksa_id')) {
                new TomSelect('#pemeriksa_id', { ...config, placeholder: 'Cari nama pemeriksa...' });
            }
            if(document.getElementById('status_gizi')) {
                new TomSelect('#status_gizi', { ...config, placeholder: 'Pilih status gizi...' });
            }
        });
    </script>
</x-layouts.panel>