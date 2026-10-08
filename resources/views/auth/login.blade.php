<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk · Posyandu Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#DAF1DE] text-[#051F20] antialiased">

<div class="grid min-h-screen lg:grid-cols-2">

    {{-- Panel informasi (desktop) --}}
    <aside class="hidden flex-col justify-between bg-[#0B2B26] p-12 text-[#DAF1DE] lg:flex">
        <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#8EB69B] text-[#051F20]">P</span>
            Posyandu Digital
        </a>
        <div>
            <h2 class="max-w-md text-4xl font-extrabold leading-tight tracking-tight">Catatan kesehatan warga, rapi di satu tempat.</h2>
            <ul class="mt-8 max-w-sm space-y-4 text-[#8EB69B]">
                <li class="flex gap-3"><span class="text-[#DAF1DE]">✓</span>Lihat jadwal dan daftar kegiatan Posyandu</li>
                <li class="flex gap-3"><span class="text-[#DAF1DE]">✓</span>Pantau riwayat pemeriksaan sendiri</li>
                <li class="flex gap-3"><span class="text-[#DAF1DE]">✓</span>Kader mencatat hasil tanpa buku kertas</li>
            </ul>
        </div>
        <p class="text-sm text-[#8EB69B]">Proyek Praktikum Pemrograman Web II</p>
    </aside>

    {{-- Form --}}
    <main class="flex items-center justify-center px-4 py-10"
          x-data="{
            email: '', password: '', show: false, loading: false, error: '', fieldErrors: {},
            async submit() {
                this.loading = true; this.error = ''; this.fieldErrors = {};
                try {
                    const csrfToken = document.querySelector('meta[name=csrf-token]')?.content ?? '';
                    const res = await fetch('/api/auth/login', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify({ email: this.email, password: this.password }),
                    });
                    const json = await res.json().catch(() => ({}));
                    if (!res.ok) {
                        if (res.status === 422) this.fieldErrors = json.errors ?? {};
                        else this.error = json.message ?? 'Terjadi kesalahan.';
                        return;
                    }
                    auth.set(json.data.token);
                    await syncSession();
                    window.location.href = '/jadwal';
                } catch (e) {
                    this.error = 'Tidak dapat terhubung ke server.';
                } finally { this.loading = false; }
            }
          }"
        x-init="if (auth.token()) syncSession().then(() => window.location.href = '/jadwal')"
        <div class="w-full max-w-sm">
            <a href="{{ route('home') }}" class="mb-8 flex items-center gap-2 font-bold text-[#0B2B26] lg:hidden">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-[#235347] text-white">P</span>
                Posyandu Digital
            </a>

            <h1 class="text-3xl font-extrabold tracking-tight text-[#0B2B26]">Masuk</h1>
            <p class="mt-2 text-sm text-[#163832]">Gunakan email dan password akun Anda.</p>

            <form @submit.prevent="submit()" class="mt-8 space-y-5">
                <div x-show="error" x-cloak role="alert" class="rounded-xl bg-rose-50 px-4 py-3 text-sm text-rose-700 ring-1 ring-rose-200" x-text="error"></div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-[#163832]">Email</label>
                    <input id="email" type="email" x-model="email" required autofocus autocomplete="email"
                           class="mt-1.5 block w-full rounded-xl border-[#8EB69B] bg-white/80 text-sm shadow-sm focus:border-[#235347] focus:ring-[#235347]">
                    <p class="mt-1 text-xs text-rose-600" x-show="fieldErrors.email" x-text="fieldErrors.email?.[0]"></p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-[#163832]">Password</label>
                    <div class="relative mt-1.5">
                        <input id="password" :type="show ? 'text' : 'password'" x-model="password" required autocomplete="current-password"
                               class="block w-full rounded-xl border-[#8EB69B] bg-white/80 pr-16 text-sm shadow-sm focus:border-[#235347] focus:ring-[#235347]">
                        <button type="button" @click="show = !show"
                                class="absolute inset-y-0 right-3 text-xs font-semibold text-[#235347] hover:text-[#0B2B26]"
                                x-text="show ? 'Sembunyi' : 'Lihat'"></button>
                    </div>
                    <p class="mt-1 text-xs text-rose-600" x-show="fieldErrors.password" x-text="fieldErrors.password?.[0]"></p>
                </div>

                <button :disabled="loading"
                        class="w-full rounded-xl bg-[#163832] py-3 text-sm font-bold text-[#DAF1DE] transition hover:bg-[#0B2B26] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#235347] focus-visible:ring-offset-2 disabled:opacity-60">
                    <span x-text="loading ? 'Memproses...' : 'Masuk'"></span>
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-[#163832]">
                Warga baru? <a href="{{ route('register') }}" class="font-semibold text-[#235347] underline underline-offset-2 hover:text-[#0B2B26]">Daftar dengan NIK</a>
            </p>
        </div>
    </main>
</div>
</body>
</html>