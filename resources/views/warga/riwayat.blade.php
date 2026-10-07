<x-layouts.panel title="Riwayat Pemeriksaan">

<div class="mx-auto max-w-4xl">

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">Riwayat Pemeriksaan</h1>
            <p class="mt-1 text-sm text-[#3C5A52]">Catatan hasil pemeriksaan kesehatan Anda di Posyandu.</p>
        </div>
    </div>

    @if($pemeriksaans->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-12 text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-slate-400">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
            </div>
            <p class="mt-4 text-base font-medium text-slate-700">Belum ada riwayat pemeriksaan</p>
            <p class="mt-1 text-sm text-slate-500">Anda belum memiliki catatan pemeriksaan di Posyandu.</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($pemeriksaans as $pemeriksaan)
                <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-sm">
                    <div class="mb-4 flex items-center justify-between border-b border-slate-100 pb-3">
                        <span class="font-extrabold text-[#051F20]">
                            Pemeriksaan {{ $pemeriksaan->tanggal ? \Carbon\Carbon::parse($pemeriksaan->tanggal)->translatedFormat('d F Y') : '-' }}
                        </span>
                        @php
                            $giziLower = strtolower($pemeriksaan->status_gizi ?? '');
                            $giziBadge = 'bg-slate-100 text-slate-700 border-slate-200';
                            if (preg_match('/baik|normal|ideal/i', $giziLower)) {
                                $giziBadge = 'bg-emerald-50 text-emerald-800 border-emerald-200';
                            } elseif (preg_match('/kurang|stunting|obesitas|sangat|risiko/i', $giziLower)) {
                                $giziBadge = 'bg-rose-50 text-rose-800 border-rose-200';
                            }
                        @endphp
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-bold border {{ $giziBadge }}">
                            {{ $pemeriksaan->status_gizi ?? '-' }}
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-y-3 text-sm sm:grid-cols-4 lg:grid-cols-6 text-center">
                        <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                            <span class="text-xs font-semibold text-[#55766A] block">Berat Badan</span>
                            <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->berat_badan ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">kg</small></span>
                        </div>
                        <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                            <span class="text-xs font-semibold text-[#55766A] block">Tinggi Badan</span>
                            <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->tinggi_badan ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">cm</small></span>
                        </div>
                        <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                            <span class="text-xs font-semibold text-[#55766A] block">Lingkar Kepala</span>
                            <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->lingkar_kepala ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">cm</small></span>
                        </div>
                        <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                            <span class="text-xs font-semibold text-[#55766A] block">Lingkar Lengan</span>
                            <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->lingkar_lengan ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">cm</small></span>
                        </div>
                        <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                            <span class="text-xs font-semibold text-[#55766A] block">Tekanan Darah</span>
                            <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->tekanan_darah ?? '-' }}</span>
                        </div>
                        <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                            <span class="text-xs font-semibold text-[#55766A] block">Gula Darah</span>
                            <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->gula_darah ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">mg/dL</small></span>
                        </div>
                    </div>
                    
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($pemeriksaan->keluhan)
                            <div>
                                <p class="text-xs font-semibold text-[#7FA08C]">Keluhan:</p>
                                <p class="mt-1 text-sm text-[#051F20] bg-slate-50 p-2.5 rounded-lg border border-slate-100">{{ $pemeriksaan->keluhan }}</p>
                            </div>
                        @endif
                        @if($pemeriksaan->catatan)
                            <div>
                                <p class="text-xs font-semibold text-[#7FA08C]">Catatan:</p>
                                <p class="mt-1 text-sm text-[#051F20] bg-slate-50 p-2.5 rounded-lg border border-slate-100">{{ $pemeriksaan->catatan }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $pemeriksaans->links() }}
        </div>
    @endif

</div>

</x-layouts.panel>
