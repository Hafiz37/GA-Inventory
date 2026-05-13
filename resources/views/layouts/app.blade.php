<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GA Inventory - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { display: flex; min-height: 100vh; background-color: #f8f9fa; }
        .sidebar { width: 250px; background: #212529; color: white; transition: 0.3s; }
        .content { flex: 1; padding: 20px; }
        .nav-link { color: rgba(255,255,255,.8); }
        .nav-link:hover, .nav-link.active { color: white; background: #343a40; }
    </style>
</head>
<body>
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4"><i class="fas fa-boxes me-2"></i> GA-INV</h4>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('assets.index') }}" class="nav-link {{ request()->routeIs('assets.*') ? 'active' : '' }}">
                    <i class="fas fa-list me-2"></i> Daftar Aset
                </a>
            </li>
            </ul>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
    </script>
    @endif
</body>
</html>
