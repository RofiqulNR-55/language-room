<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - LanguangeRoom</title>
    
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    {{-- CSS Khusus Admin --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="d-flex" id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom">LanguangeRoom</div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action p-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt fa-fw me-2"></i>Dashboard</a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->routeIs('admin.paket.*') ? 'active' : '' }}" href="{{ route('admin.paket.index') }}"><i class="fas fa-box-open fa-fw me-2"></i>Manajemen Paket</a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->routeIs('admin.langganan.*') ? 'active' : '' }}" href="{{ route('admin.langganan.index') }}"><i class="fas fa-box-open fa-fw me-2"></i>Daftar langganan siswa</a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->routeIs('admin.verifikasi.*') ? 'active' : '' }}" href="{{ route('admin.verifikasi.index') }}"><i class="fas fa-check-circle fa-fw me-2"></i>Riwayat Transaksi</a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->routeIs('admin.modul.*') ? 'active' : '' }}" href="{{ route('admin.modul.index') }}"><i class="fas fa-book fa-fw me-2"></i>Manajemen Modul</a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->routeIs('admin.video.*') ? 'active' : '' }}" href="{{ route('admin.video.index') }}"><i class="fas fa-video fa-fw me-2"></i>Manajemen Video</a>
            <a class="list-group-item list-group-item-action p-3 {{ request()->routeIs('admin.quiz.*') ? 'active' : '' }}" href="{{ route('admin.quiz.index') }}"><i class="fas fa-question-circle fa-fw me-2"></i>Manajemen Kuis</a>
        </div>
    </div>
    <div id="page-content-wrapper" class="w-100">
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <button class="btn btn-primary me-2" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarAdmin">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Profil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" id="logout-link">Logout</a>
                            </div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid p-4">
            @yield('content')
        </div>
    </div>
</div>

<!-- Script sidebar toggle agar responsif di mobile dan logout -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.getElementById('sidebar-wrapper').classList.toggle('d-none');
    });
    document.getElementById('logout-link').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('logout-form').submit();
        setTimeout(function() {
            window.location.href = '/';
        }, 500);
    });
</script>

</body>
</html>