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

    if (res.status === 401) {
        auth.clear();
        window.location.href = '/login';
    }
    if (!res.ok) throw { status: res.status, ...json };

    return json;
}

let meCache = null;

export function getMe() {
    meCache ??= api('/auth/me')
        .then((r) => r.data)
        .catch((e) => { meCache = null; throw e; });
    return meCache;
}

export function toast(message, type = 'success') {
    window.dispatchEvent(new CustomEvent('toast', { detail: { message, type } }));
}