<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Jadwal</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('jadwal.update', $jadwal) }}" class="bg-white p-6 shadow-sm sm:rounded-lg">
                @csrf @method('PUT')
                @include('jadwal._form')
                <div class="mt-6 flex justify-end gap-2">
                    <a href="{{ route('jadwal.index') }}" class="px-4 py-2 border rounded-md text-gray-700">Batal</a>
                    <x-primary-button>Perbarui</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>