<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow-lg">
    {{-- Merek / Judul --}}
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 fw-bold text-uppercase" href="#">
        <i class="bi bi-gear-fill me-1"></i> Tugas Mas Ivan
    </a>

    {{-- Tombol Toggle Sidebar untuk Mobile --}}
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button"
            data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-nav ms-auto me-3">
        <div class="nav-item text-nowrap">

        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">
                Logout
            </button>
        </form>



        </div>
    </div>
</header>
