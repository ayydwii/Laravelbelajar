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

    <div class="navbar-nav ms-auto">
        <div class="nav-item text-nowrap">

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-dark btn-sm border-0 rounded-0">
                    <i class="bi bi-box-arrow-right"></i> Sign out
                </button>
            </form>

        </div>
    </div>
</header>
