<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Beranda' }} · Posyandu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak]{display:none!important}
    </style>
</head>
@php
    $menu = [
        ['label'=>'Warga','route'=>'warga.index','match'=>'warga.*'],
        ['label'=>'Kegiatan','route'=>'kegiatan.index','match'=>'kegiatan.*'],
        ['label'=>'Jadwal','route'=>'jadwal.index','match'=>'jadwal.*'],
        ['label'=>'Pemeriksaan','route'=>'pemeriksaan.index','match'=>'pemeriksaan.*'],
    ];
    $linkBase = 'whitespace-nowrap rounded-lg px-3 py-1.5 text-sm font-medium transition';
    $linkActive = 'bg-emerald-50 text-emerald-700';
    $linkIdle = 'text-slate-600 hover:bg-slate-100';
@endphp
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
<header
    x-data="{
        user:null,
        menuOpen:false,
        async logout(){
            try{await api('/auth/logout',{method:'POST'});}catch(e){}
            auth.clear();
            window.location.href='/login';
        }
    }"
    x-init="getMe().then(u=>user=u).catch(()=>{})"
    @keydown.escape.window="menuOpen=false"
    class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur"
>
    <div class="mx-auto flex max-w-7xl items-center gap-3 px-4 py-3 sm:px-6 lg:px-8">
        <button
            type="button"
            @click="menuOpen=!menuOpen"
            :aria-expanded="menuOpen"
            aria-label="Buka menu"
            class="-ml-1 rounded-lg p-2 text-slate-600 hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 md:hidden"
        >
            <svg x-show="!menuOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="menuOpen" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <a href="/" class="flex shrink-0 items-center gap-2">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-lg font-bold text-white">P</span>
            <span class="hidden text-base font-semibold text-slate-900 sm:block">Posyandu</span>
        </a>

        <nav class="hidden flex-1 items-center gap-1 md:flex">
            @foreach($menu as $m)
                <a
                    href="{{ route($m['route']) }}"
                    class="{{ $linkBase }} {{ request()->routeIs($m['match']) ? $linkActive : $linkIdle }}"
                >
                    {{ $m['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex-1 md:hidden"></div>

        <div x-show="user" x-cloak class="flex shrink-0 items-center gap-3">
            <div class="hidden text-right sm:block">
                <p class="text-sm font-medium leading-tight text-slate-900" x-text="user?.name"></p>
                <p class="text-xs capitalize text-slate-500" x-text="user?.role"></p>
            </div>
            <span
                class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-sm font-semibold text-emerald-700"
                x-text="(user?.name||'?').charAt(0).toUpperCase()"
            ></span>
            <button
                @click="logout()"
                class="rounded-lg border border-slate-200 px-3 py-1.5 text-sm text-slate-600 transition hover:bg-slate-100"
            >
                Keluar
            </button>
        </div>
    </div>

    <nav
        x-show="menuOpen"
        x-cloak
        x-transition.opacity
        class="border-t border-slate-100 bg-white px-4 py-2 md:hidden"
    >
        <div class="mx-auto flex max-w-7xl flex-col gap-1">
            @foreach($menu as $m)
                <a
                    href="{{ route($m['route']) }}"
                    class="{{ $linkBase }} py-2.5 {{ request()->routeIs($m['match']) ? $linkActive : $linkIdle }}"
                >
                    {{ $m['label'] }}
                </a>
            @endforeach
        </div>
    </nav>
</header>

<main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    {{ $slot }}
</main>

<div
    x-data="{items:[],n:0}"
    @toast.window="
        const id=++n;
        items.push({id,...$event.detail});
        setTimeout(()=>items=items.filter(i=>i.id!==id),4000);
    "
    class="pointer-events-none fixed inset-x-4 top-4 z-50 flex flex-col items-end gap-2"
>
    <template x-for="t in items" :key="t.id">
        <div
            x-transition
            class="pointer-events-auto w-full max-w-sm rounded-xl px-4 py-3 text-sm font-medium shadow-lg ring-1"
            :class="t.type==='error'
                ? 'bg-rose-50 text-rose-800 ring-rose-200'
                : 'bg-emerald-50 text-emerald-800 ring-emerald-200'"
            x-text="t.message"
        ></div>
    </template>
</div>
</body>
</html>