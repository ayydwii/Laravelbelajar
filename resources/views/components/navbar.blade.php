<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow-lg">
    {{-- Merek / Judul --}}
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 fw-bold text-uppercase" href="#">
        <i class="bi bi-gear-fill me-1"></i> ADMIN DASHBOARD
    </a>

    {{-- Tombol Toggle Sidebar untuk Mobile --}}
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
            data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Menu Kanan (Sign Out) --}}
    <div class="navbar-nav ms-auto">
        <div class="nav-item text-nowrap">

            {{-- Form Logout Sesungguhnya --}}
            <form action="URL_UNTUK_LOGOUT" method="POST" class="d-inline">
                {{-- @csrf --}} <button type="submit" class="nav-link px-3 text-white bg-transparent border-0"
                        title="Sign Out">
                    <i class="bi bi-box-arrow-right"></i> Sign out
                </button>
            </form>

        </div>
    </div>
</header>
