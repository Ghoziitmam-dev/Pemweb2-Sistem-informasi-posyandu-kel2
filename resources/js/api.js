const TOKEN_KEY = 'posyandu_token';

export const auth = {
    token: () => localStorage.getItem(TOKEN_KEY),
    set: (t) => localStorage.setItem(TOKEN_KEY, t),
    clear: () => localStorage.removeItem(TOKEN_KEY),
};

export async function api(path, { method = 'GET', body, params } = {}) {
    const url = new URL('/api' + path, window.location.origin);
    Object.entries(params ?? {}).forEach(([k, v]) => {
        if (v !== '' && v != null) url.searchParams.set(k, v);
    });

    const res = await fetch(url, {
        method,
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            ...(auth.token() ? { Authorization: `Bearer ${auth.token()}` } : {}),
        },
        body: body ? JSON.stringify(body) : undefined,
    });

    const json = await res.json().catch(() => ({}));

    if (!res.ok) throw { status: res.status, ...json };

    return json;
}

let meCache = null;

export async function getMe() {
    if (meCache) return meCache;

    try {
        const r = await api('/auth/me');
        meCache = r.data;
        return meCache;
    } catch (e) {
        meCache = null;
        if (e.status === 401) {
            // Token tidak valid — hapus token dan kembalikan null
            // JANGAN redirect di sini; biarkan halaman yang memutuskan
            auth.clear();
            return null;
        }
        throw e;
    }
}

export function clearMeCache() {
    meCache = null;
}

export function toast(message, type = 'success') {
    window.dispatchEvent(new CustomEvent('toast', { detail: { message, type } }));
}