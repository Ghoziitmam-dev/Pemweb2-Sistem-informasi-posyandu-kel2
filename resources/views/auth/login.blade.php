<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk · Posyandu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none !important}</style>
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-50 px-4 text-slate-800 antialiased">

<div class="w-full max-w-sm"
     x-data="{
        email: '', password: '', loading: false, error: '', fieldErrors: {},
        async submit() {
            this.loading = true; this.error = ''; this.fieldErrors = {};
            try {
                const res = await fetch('/api/auth/login', {
                    method: 'POST',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email: this.email, password: this.password }),
                });
                const json = await res.json().catch(() => ({}));

                if (!res.ok) {
                    if (res.status === 422) this.fieldErrors = json.errors ?? {};
                    else this.error = json.message ?? 'Terjadi kesalahan.';
                    return;
                }
                auth.set(json.data.token);
                window.location.href = '/jadwal';
            } catch (e) {
                this.error = 'Tidak dapat terhubung ke server.';
            } finally { this.loading = false; }
        }
     }"
     x-init="if (auth.token()) window.location.href = '/jadwal'">

    <div class="mb-6 text-center">
        <span class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-600 text-2xl font-bold text-white">P</span>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Masuk ke Posyandu</h1>
        <p class="mt-1 text-sm text-slate-500">Gunakan akun yang sudah terdaftar.</p>
    </div>

    <form @submit.prevent="submit()" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div x-show="error" x-cloak class="rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700" x-text="error"></div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Email</label>
            <input type="email" x-model="email" required autofocus
                   class="mt-1 block w-full rounded-lg border border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            <p class="mt-1 text-xs text-rose-600" x-show="fieldErrors.email" x-text="fieldErrors.email?.[0]"></p>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700">Password</label>
            <input type="password" x-model="password" required
                   class="mt-1 block w-full rounded-lg border border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
            <p class="mt-1 text-xs text-rose-600" x-show="fieldErrors.password" x-text="fieldErrors.password?.[0]"></p>
        </div>

        <button :disabled="loading"
                class="w-full rounded-lg bg-emerald-600 py-2.5 text-sm font-semibold text-white transition hover:bg-emerald-700 disabled:opacity-60">
            <span x-text="loading ? 'Memproses...' : 'Masuk'"></span>
        </button>

        <p class="text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-emerald-700 hover:underline">Daftar</a></p>
    </form>
</div>
</body>
</html>