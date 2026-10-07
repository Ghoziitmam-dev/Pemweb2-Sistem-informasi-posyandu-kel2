<x-layouts.panel title="Pemeriksaan">
@php
    $btn = 'inline-flex items-center justify-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 disabled:opacity-50';
    $primary = $btn.' bg-emerald-600 text-white hover:bg-emerald-700';
    $ghost = $btn.' border border-slate-200 text-slate-600 hover:bg-slate-50';
    $input = 'block w-full rounded-lg border border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500';
@endphp

<div x-data="pemeriksaanPage()" x-init="init()">

    {{-- Header --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Data Pemeriksaan</h1>
            <p class="mt-1 text-sm text-slate-500">Hasil pemeriksaan kesehatan warga pada setiap jadwal kegiatan.</p>
        </div>
        <a x-show="isStaff" x-cloak href="/pemeriksaan/create"
           class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 focus-visible:ring-offset-2">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            Tambah Pemeriksaan
        </a>
    </div>

    {{-- Filter --}}
    <div class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
        <div class="grid gap-3 md:grid-cols-12">
            <div class="md:col-span-6">
                <label class="mb-1 block text-xs font-medium text-slate-500">Cari warga</label>
                <input type="search" x-model="filters.search" @input.debounce.400ms="load(1)"
                       placeholder="Nama atau NIK..." class="{{ $input }}">
            </div>
            <div class="md:col-span-4">
                <label class="mb-1 block text-xs font-medium text-slate-500">Tanggal</label>
                <input type="date" x-model="filters.tanggal" @change="load(1)" class="{{ $input }}">
            </div>
            <div class="flex items-end md:col-span-2">
                <button type="button" @click="resetFilter()"
                        :disabled="!filters.search && !filters.tanggal"
                        class="{{ $ghost }} w-full py-2.5 text-sm">Reset</button>
            </div>
        </div>
    </div>

    {{-- Tabel (tablet ke atas) --}}
    <div class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm md:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-emerald-50 text-left text-xs font-semibold text-emerald-900">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Warga</th>
                        <th class="px-4 py-3">Jadwal</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3 text-right">Berat</th>
                        <th class="px-4 py-3 text-right">Tinggi</th>
                        <th class="px-4 py-3">Tekanan darah</th>
                        <th class="px-4 py-3">Status gizi</th>
                        <th class="px-4 py-3">Pemeriksa</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">

                    {{-- Skeleton --}}
                    <template x-for="n in (loading && !items.length ? 5 : 0)" :key="'s'+n">
                        <tr class="animate-pulse">
                            <td colspan="10" class="px-4 py-4"><div class="h-4 rounded bg-slate-100"></div></td>
                        </tr>
                    </template>

                    <template x-for="(item, idx) in items" :key="item.id">
                        <tr class="transition hover:bg-emerald-50/40">
                            <td class="px-4 py-3 tabular-nums text-slate-500" x-text="no(idx)"></td>
                            <td class="px-4 py-3">
                                <p class="font-medium text-slate-900" x-text="f.warga(item)"></p>
                                <p class="text-xs text-slate-500" x-text="f.nik(item)"></p>
                            </td>
                            <td class="px-4 py-3 text-slate-600" x-text="f.jadwal(item)"></td>
                            <td class="whitespace-nowrap px-4 py-3 text-slate-600" x-text="tgl(f.tanggal(item))"></td>
                            <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums" x-text="unit(f.berat(item), 'kg')"></td>
                            <td class="whitespace-nowrap px-4 py-3 text-right tabular-nums" x-text="unit(f.tinggi(item), 'cm')"></td>
                            <td class="whitespace-nowrap px-4 py-3 tabular-nums" x-text="f.tensi(item) || '-'"></td>
                            <td class="px-4 py-3">
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset"
                                      :class="gizi(f.gizi(item))" x-text="f.gizi(item) || '-'"></span>
                            </td>
                            <td class="px-4 py-3 text-slate-600" x-text="f.pemeriksa(item) || '-'"></td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-1">
                                    <a x-show="isStaff" :href="`/pemeriksaan/${item.id}/edit`" class="{{ $ghost }}">Edit</a>
                                    <button x-show="isStaff" @click="hapus(item)" class="{{ $btn }} text-rose-600 hover:bg-rose-50">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Kartu (HP) --}}
    <div class="space-y-3 md:hidden">
        <template x-for="item in items" :key="'m'+item.id">
            <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="truncate font-semibold text-slate-900" x-text="f.warga(item)"></p>
                        <p class="text-xs text-slate-500" x-text="f.nik(item)"></p>
                    </div>
                    <span class="shrink-0 rounded-full px-2.5 py-0.5 text-xs font-semibold ring-1 ring-inset"
                          :class="gizi(f.gizi(item))" x-text="f.gizi(item) || '-'"></span>
                </div>
                <p class="mt-2 text-sm text-slate-600" x-text="f.jadwal(item) + ' · ' + tgl(f.tanggal(item))"></p>

                <dl class="mt-3 grid grid-cols-3 gap-2 rounded-xl bg-emerald-50/60 p-3 text-center">
                    <div><dt class="text-xs text-slate-500">Berat</dt><dd class="text-sm font-semibold tabular-nums text-slate-900" x-text="unit(f.berat(item), 'kg')"></dd></div>
                    <div><dt class="text-xs text-slate-500">Tinggi</dt><dd class="text-sm font-semibold tabular-nums text-slate-900" x-text="unit(f.tinggi(item), 'cm')"></dd></div>
                    <div><dt class="text-xs text-slate-500">Tensi</dt><dd class="text-sm font-semibold tabular-nums text-slate-900" x-text="f.tensi(item) || '-'"></dd></div>
                </dl>

                <div class="mt-3 flex items-center justify-between gap-2">
                    <p class="truncate text-xs text-slate-500" x-text="'Pemeriksa: ' + (f.pemeriksa(item) || '-')"></p>
                    <div x-show="isStaff" class="flex gap-1">
                        <a :href="`/pemeriksaan/${item.id}/edit`" class="{{ $ghost }}">Edit</a>
                        <button @click="hapus(item)" class="{{ $btn }} text-rose-600 hover:bg-rose-50">Hapus</button>
                    </div>
                </div>
            </article>
        </template>
    </div>

    {{-- Kosong --}}
    <div x-show="!loading && !items.length" x-cloak
         class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center">
        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-50 text-emerald-600">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
        </div>
        <p class="mt-4 text-base font-medium text-slate-700">Belum ada data pemeriksaan</p>
        <p class="mt-1 text-sm text-slate-500">Data muncul setelah kader mencatat pemeriksaan pada sebuah jadwal.</p>
    </div>

    {{-- Pagination --}}
    <div x-show="meta && meta.last_page > 1" x-cloak
         class="mt-6 flex flex-col items-center justify-between gap-3 sm:flex-row">
        <p class="text-sm text-slate-500">
            Menampilkan <span x-text="meta?.from"></span>-<span x-text="meta?.to"></span>
            dari <span x-text="meta?.total"></span> pemeriksaan
        </p>
        <div class="flex items-center gap-2">
            <button @click="load(meta.current_page - 1)" :disabled="meta?.current_page <= 1" class="{{ $ghost }} px-4">Sebelumnya</button>
            <span class="px-2 text-sm text-slate-600" x-text="meta?.current_page + ' / ' + meta?.last_page"></span>
            <button @click="load(meta.current_page + 1)" :disabled="meta?.current_page >= meta?.last_page" class="{{ $ghost }} px-4">Berikutnya</button>
        </div>
    </div>

    {{-- Konfirmasi hapus --}}
    <div x-show="confirmBox.open" x-cloak class="fixed inset-0 z-40 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/50" @click="confirmBox.open = false" x-transition.opacity></div>
        <div x-show="confirmBox.open" x-transition class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl">
            <h2 class="text-lg font-semibold text-slate-900">Hapus pemeriksaan?</h2>
            <p class="mt-2 text-sm text-slate-600" x-text="confirmBox.text"></p>
            <div class="mt-6 flex justify-end gap-2">
                <button @click="confirmBox.open = false" class="{{ $ghost }} px-4 py-2 text-sm">Tidak</button>
                <button @click="runConfirm()" :disabled="confirmBox.busy"
                        class="{{ $btn }} bg-rose-600 px-4 py-2 text-sm text-white hover:bg-rose-700"
                        x-text="confirmBox.busy ? 'Memproses...' : 'Ya, hapus'"></button>
            </div>
        </div>
    </div>
</div>

@verbatim
<script>
function pemeriksaanPage() {
    return {
        user: null,
        items: [],
        meta: null,
        loading: true,
        filters: { search: '', tanggal: '', page: 1 },
        confirmBox: { open: false, text: '', busy: false, action: null },

        /*
         * PEMETAAN FIELD. Kalau nama field dari API kamu beda,
         * cukup ubah di sini, tampilan tidak perlu disentuh.
         */
        f: {
            warga:     i => i.warga?.nama,
            nik:       i => i.warga?.nik,
            jadwal:    i => i.jadwal?.kegiatan?.judul ?? i.jadwal?.nama ?? '-',
            tanggal:   i => i.tanggal ?? i.jadwal?.tanggal,
            berat:     i => i.berat_badan ?? i.berat,
            tinggi:    i => i.tinggi_badan ?? i.tinggi,
            tensi:     i => i.tekanan_darah ?? i.tensi,
            gizi:      i => i.status_gizi_label ?? i.status_gizi,
            pemeriksa: i => i.pemeriksa?.name ?? i.pemeriksa,
        },

        get isStaff() { return !!this.user && ['admin', 'kader'].includes(this.user.role); },

        async init() {
            if (!auth.token()) { window.location.href = '/login'; return; }
            try { this.user = await getMe(); } catch (e) { this.err(e); }
            await this.load(1);
        },

        async load(page = 1) {
            this.loading = true;
            this.filters.page = page;
            try {
                const r = await api('/pemeriksaan', { params: { ...this.filters, per_page: 10 } });
                this.items = r.data;
                this.meta = r.meta;
            } catch (e) { this.err(e); }
            finally { this.loading = false; }
        },

        resetFilter() {
            this.filters = { search: '', tanggal: '', page: 1 };
            this.load(1);
        },

        err(e) { toast(e.message || 'Terjadi kesalahan.', 'error'); },

        // ---------- tampilan ----------
        no(idx) { return ((this.meta?.current_page ?? 1) - 1) * (this.meta?.per_page ?? this.items.length) + idx + 1; },
        unit(v, u) { return v === null || v === undefined || v === '' ? '-' : `${v} ${u}`; },
        tgl(v) {
            if (!v) return '-';
            return new Date(String(v).slice(0, 10) + 'T00:00:00')
                .toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
        },
        gizi(s) {
            const t = String(s || '').toLowerCase();
            if (/buruk|stunting|obesitas|sangat/.test(t)) return 'bg-rose-50 text-rose-700 ring-rose-200';
            if (/kurang|lebih|risiko|waspada/.test(t))     return 'bg-amber-50 text-amber-700 ring-amber-200';
            if (/baik|normal|ideal/.test(t))               return 'bg-emerald-50 text-emerald-700 ring-emerald-200';
            return 'bg-slate-100 text-slate-600 ring-slate-200';
        },

        // ---------- hapus ----------
        hapus(i) {
            this.confirmBox = {
                open: true, busy: false,
                text: `Data pemeriksaan ${this.f.warga(i) ?? ''} akan dihapus permanen.`,
                action: async () => {
                    const r = await api(`/pemeriksaan/${i.id}`, { method: 'DELETE' });
                    toast(r.message);
                    await this.load(this.items.length === 1 ? Math.max(1, this.filters.page - 1) : this.filters.page);
                },
            };
        },
        async runConfirm() {
            this.confirmBox.busy = true;
            try { await this.confirmBox.action(); }
            catch (e) { this.err(e); }
            finally { this.confirmBox.busy = false; this.confirmBox.open = false; }
        },
    };
}
</script>
@endverbatim
</x-layouts.panel>