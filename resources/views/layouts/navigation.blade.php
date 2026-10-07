<nav class="main-navbar">
    <div class="navbar-container">

        <div class="navbar-left">

            <a href="{{ route('dashboard') }}" class="navbar-brand">
                <span class="brand-icon">P</span>
                <span>Posyandu</span>
            </a>

            <div class="navbar-menu">

                <a href="{{ route('warga.index') }}"
                   class="nav-item {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                    Warga
                </a>

                <a href="{{ route('kegiatan.index') }}"
                   class="nav-item {{ request()->routeIs('kegiatan.*') ? 'active' : '' }}">
                    Kegiatan
                </a>

                <a href="{{ route('jadwal.index') }}"
                   class="nav-item {{ request()->routeIs('jadwal.*') ? 'active' : '' }}">
                    Jadwal
                </a>

                <a href="{{ route('pemeriksaan.index') }}"
                   class="nav-item {{ request()->routeIs('pemeriksaan.*') ? 'active' : '' }}">
                    Pemeriksaan
                </a>

            </div>

        </div>

        @auth
            <div class="navbar-user">

                <div class="user-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>Admin</span>
                </div>

                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-btn">
                        Keluar
                    </button>
                </form>

            </div>
        @else
            <div class="navbar-user">
                <span class="guest-text">Guest</span>
            </div>
        @endauth

    </div>
</nav>

<style>
    .main-navbar {
        width: 100%;
        height: 54px;
        background: #ffffff;
        border-bottom: 1px solid #dce9e1;
    }

    .navbar-container {
        width: 100%;
        max-width: 1200px;
        height: 54px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .navbar-left {
        display: flex;
        align-items: center;
        height: 100%;
        gap: 25px;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        gap: 9px;
        color: #173f36;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
        white-space: nowrap;
    }

    .brand-icon {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #205c4f;
        color: #ffffff;
        border-radius: 10px;
        font-size: 17px;
        font-weight: 700;
    }

    .navbar-menu {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        height: 36px;
        padding: 0 13px;
        color: #35584f;
        text-decoration: none;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        transition: .2s ease;
    }

    .nav-item:hover {
        background: #f0f7f3;
        color: #205c4f;
    }

    .nav-item.active {
        background: #e5f3e9;
        color: #174f42;
    }

    .navbar-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        line-height: 1.2;
    }

    .user-info strong {
        color: #244d43;
        font-size: 12px;
        font-weight: 700;
    }

    .user-info span {
        margin-top: 2px;
        color: #789088;
        font-size: 10px;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #dff1e5;
        color: #25594c;
        border-radius: 50%;
        font-size: 12px;
        font-weight: 600;
    }

    .logout-btn {
        height: 34px;
        padding: 0 13px;
        color: #4f6b63;
        background: #ffffff;
        border: 1px solid #d2e3d9;
        border-radius: 8px;
        font-family: inherit;
        font-size: 11px;
        cursor: pointer;
        transition: .2s ease;
    }

    .logout-btn:hover {
        background: #f0f7f3;
        color: #205c4f;
    }

    .guest-text {
        color: #617970;
        font-size: 12px;
    }

    @media (max-width: 800px) {
        .navbar-container {
            padding: 0 14px;
        }

        .navbar-left {
            gap: 10px;
        }

        .navbar-brand > span:last-child {
            display: none;
        }

        .nav-item {
            padding: 0 9px;
            font-size: 11px;
        }

        .user-info,
        .logout-btn {
            display: none;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
        }
    }

    @media (max-width: 560px) {
        .navbar-container {
            overflow-x: auto;
        }

        .navbar-left {
            flex-shrink: 0;
        }

        .navbar-user {
            margin-left: auto;
            flex-shrink: 0;
        }

        .nav-item {
            padding: 0 7px;
        }
    }
</style>