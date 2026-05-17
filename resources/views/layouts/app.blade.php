<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GA Inventory — @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ══════════════════════════════════════
           DESIGN TOKENS
        ══════════════════════════════════════ */
        :root {
            --bg-base:        #080c14;
            --bg-surface:     #0d1117;
            --bg-card:        #111827;
            --bg-card-2:      #161f2e;
            --bg-input:       #0d1117;
            --border:         rgba(255,255,255,.07);
            --border-focus:   #6366f1;
            --text-base:      #cbd5e1;
            --text-heading:   #f1f5f9;
            --text-muted:     #64748b;
            --text-sub:       #475569;
            --accent:         #6366f1;
            --accent-2:       #8b5cf6;
            --accent-glow:    rgba(99,102,241,.25);
            --green:          #10b981;
            --yellow:         #f59e0b;
            --red:            #ef4444;
            --blue:           #3b82f6;
            --sidebar-w:      240px;
            --radius:         14px;
            --radius-sm:      8px;
        }

        /* ══════════════════════════════════════
           BASE
        ══════════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
            background: var(--bg-base);
            color: var(--text-base);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
            line-height: 1.6;
        }

        a { text-decoration: none; }

        /* ══════════════════════════════════════
           SIDEBAR
        ══════════════════════════════════════ */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--bg-surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            z-index: 200;
        }

        .sb-brand {
            padding: 22px 20px 18px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sb-logo {
            width: 38px; height: 38px;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; color: #fff;
            box-shadow: 0 0 20px var(--accent-glow);
            flex-shrink: 0;
        }

        .sb-brand-text { line-height: 1.2; }
        .sb-brand-text span:first-child { display: block; font-weight: 700; font-size: 15px; color: var(--text-heading); }
        .sb-brand-text span:last-child  { display: block; font-size: 11px; color: var(--text-muted); margin-top: 1px; }

        .sb-nav { padding: 14px 12px; flex: 1; overflow-y: auto; }

        .sb-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--text-sub);
            padding: 8px 10px 6px;
        }

        .sb-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 12px;
            border-radius: var(--radius-sm);
            color: var(--text-muted);
            font-size: 13.5px;
            font-weight: 500;
            transition: all .18s;
            margin-bottom: 2px;
        }

        .sb-link i { width: 17px; text-align: center; font-size: 13px; }

        .sb-link:hover {
            color: var(--text-base);
            background: rgba(255,255,255,.05);
        }

        .sb-link.active {
            color: #fff;
            background: linear-gradient(135deg, var(--accent), var(--accent-2));
            box-shadow: 0 4px 18px var(--accent-glow);
        }

        .sb-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sb-footer-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--green);
            box-shadow: 0 0 6px var(--green);
        }

        .sb-footer span { font-size: 11.5px; color: var(--text-muted); }

        /* ══════════════════════════════════════
           TOPBAR
        ══════════════════════════════════════ */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: 58px;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border);
            z-index: 100;
            display: flex;
            align-items: center;
            padding: 0 28px;
            gap: 16px;
        }

        .topbar-breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: 13px; color: var(--text-muted);
            flex: 1;
        }

        .topbar-breadcrumb strong { color: var(--text-heading); font-weight: 600; }
        .topbar-breadcrumb i { font-size: 11px; }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .topbar-badge {
            display: flex; align-items: center; gap: 6px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 12px; color: var(--text-muted);
        }

        /* ══════════════════════════════════════
           MAIN WRAPPER
        ══════════════════════════════════════ */
        .main-wrap {
            margin-left: var(--sidebar-w);
            padding-top: 58px;
            flex: 1;
            min-height: 100vh;
        }

        .page-body {
            padding: 28px 30px;
        }

        /* ══════════════════════════════════════
           CARDS
        ══════════════════════════════════════ */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border) !important;
            border-radius: var(--radius) !important;
            color: var(--text-base);
            box-shadow: 0 1px 3px rgba(0,0,0,.4);
        }

        .card-header {
            background: var(--bg-card-2) !important;
            border-bottom: 1px solid var(--border) !important;
            border-radius: var(--radius) var(--radius) 0 0 !important;
            padding: 14px 20px;
        }

        /* ══════════════════════════════════════
           STAT CARDS
        ══════════════════════════════════════ */
        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px 22px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: border-color .2s, box-shadow .2s;
        }

        .stat-card:hover {
            border-color: rgba(99,102,241,.3);
            box-shadow: 0 4px 24px rgba(0,0,0,.3);
        }

        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .stat-icon.purple { background: rgba(99,102,241,.15); color: #818cf8; }
        .stat-icon.green  { background: rgba(16,185,129,.15);  color: #34d399; }
        .stat-icon.yellow { background: rgba(245,158,11,.15);  color: #fbbf24; }
        .stat-icon.red    { background: rgba(239,68,68,.15);   color: #f87171; }

        .stat-info { flex: 1; }
        .stat-value { font-size: 26px; font-weight: 700; color: var(--text-heading); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--text-muted); margin-top: 3px; }

        /* ══════════════════════════════════════
           TABLE
        ══════════════════════════════════════ */
        .table {
            color: var(--text-base) !important;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
            margin: 0;
        }

        .table thead tr th {
            background: var(--bg-card-2) !important;
            color: var(--text-muted) !important;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 13px 18px;
            border-bottom: 1px solid var(--border) !important;
            border-top: none !important;
            white-space: nowrap;
        }

        .table tbody tr td {
            padding: 14px 18px;
            border-bottom: 1px solid var(--border) !important;
            border-top: none !important;
            vertical-align: middle;
        }

        .table tbody tr:last-child td { border-bottom: none !important; }

        .table tbody tr {
            transition: background .15s;
        }

        .table tbody tr:hover td {
            background: rgba(255,255,255,.03) !important;
        }

        .table tbody tr td {
            background: var(--bg-card-2) !important;
        }

        .table tbody tr:hover td {
            background: var(--bg-card-hover, #1c2535) !important;
        }

        .table tbody tr.row-danger td {
            background: rgba(239,68,68,.08) !important;
        }

        .table tbody tr.row-danger:hover td {
            background: rgba(239,68,68,.13) !important;
        }

        .row-danger td {
            background: rgba(239,68,68,.05) !important;
        }

        .row-danger:hover td {
            background: rgba(239,68,68,.08) !important;
        }

        /* ══════════════════════════════════════
           BADGES
        ══════════════════════════════════════ */
        .badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 9px;
            border-radius: 6px;
            letter-spacing: .3px;
        }

        .badge-green  { background: rgba(16,185,129,.12); color: #34d399; border: 1px solid rgba(16,185,129,.2); }
        .badge-yellow { background: rgba(245,158,11,.12);  color: #fbbf24; border: 1px solid rgba(245,158,11,.2); }
        .badge-red    { background: rgba(239,68,68,.12);   color: #f87171; border: 1px solid rgba(239,68,68,.2); }
        .badge-blue   { background: rgba(59,130,246,.12);  color: #60a5fa; border: 1px solid rgba(59,130,246,.2); }
        .badge-purple { background: rgba(99,102,241,.12);  color: #a5b4fc; border: 1px solid rgba(99,102,241,.2); }

        /* ══════════════════════════════════════
           FORM CONTROLS
        ══════════════════════════════════════ */
        .form-control, .form-select {
            background: var(--bg-input) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-base) !important;
            border-radius: var(--radius-sm) !important;
            padding: 9px 13px;
            font-size: 13.5px;
            transition: border-color .18s, box-shadow .18s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--border-focus) !important;
            box-shadow: 0 0 0 3px var(--accent-glow) !important;
            outline: none;
        }

        .form-control::placeholder { color: var(--text-sub) !important; }

        .form-select option { background: var(--bg-card); }

        .form-label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        /* ══════════════════════════════════════
           BUTTONS
        ══════════════════════════════════════ */
        .btn {
            border-radius: var(--radius-sm) !important;
            font-size: 13.5px;
            font-weight: 600;
            padding: 8px 16px;
            transition: all .18s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent), var(--accent-2)) !important;
            color: #fff !important;
            box-shadow: 0 4px 14px var(--accent-glow);
        }
        .btn-primary:hover { opacity: .9; transform: translateY(-1px); box-shadow: 0 6px 20px var(--accent-glow); }

        .btn-secondary {
            background: var(--bg-card-2) !important;
            border: 1px solid var(--border) !important;
            color: var(--text-base) !important;
        }
        .btn-secondary:hover { background: rgba(255,255,255,.08) !important; color: var(--text-heading) !important; }

        .btn-success {
            background: linear-gradient(135deg, #059669, #047857) !important;
            color: #fff !important;
            box-shadow: 0 4px 14px rgba(5,150,105,.3);
        }
        .btn-success:hover { opacity: .9; transform: translateY(-1px); }

        .btn-icon {
            width: 32px; height: 32px;
            border-radius: var(--radius-sm) !important;
            padding: 0 !important;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 13px;
        }

        .btn-icon-edit {
            background: rgba(99,102,241,.12) !important;
            border: 1px solid rgba(99,102,241,.2) !important;
            color: #a5b4fc !important;
        }
        .btn-icon-edit:hover { background: rgba(99,102,241,.25) !important; color: #fff !important; }

        .btn-icon-del {
            background: rgba(239,68,68,.1) !important;
            border: 1px solid rgba(239,68,68,.2) !important;
            color: #f87171 !important;
        }
        .btn-icon-del:hover { background: rgba(239,68,68,.22) !important; color: #fff !important; }

        /* ══════════════════════════════════════
           PAGE HEADER
        ══════════════════════════════════════ */
        .page-title { font-size: 20px; font-weight: 700; color: var(--text-heading); }
        .page-sub   { font-size: 13px; color: var(--text-muted); margin-top: 2px; }

        /* ══════════════════════════════════════
           MISC
        ══════════════════════════════════════ */
        hr { border-color: var(--border) !important; margin: 20px 0; }

        textarea { resize: vertical; }

        .text-accent { color: #818cf8; }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }
    </style>
</head>
<body>

    <!-- ══ SIDEBAR ══ -->
    <aside class="sidebar">
        <div class="sb-brand">
            <div class="sb-logo"><i class="fas fa-boxes"></i></div>
            <div class="sb-brand-text">
                <span>GA Inventory</span>
                <span>Asset Management</span>
            </div>
        </div>

        <nav class="sb-nav">
            <div class="sb-section-label">Main Menu</div>
            <a href="{{ route('assets.index') }}"
               class="sb-link {{ request()->routeIs('assets.*') ? 'active' : '' }}">
                <i class="fas fa-layer-group"></i> Manajemen Aset
            </a>
        </nav>

        <div class="sb-footer">
            <div class="sb-footer-dot"></div>
            <span>System Online &bull; v1.0</span>
        </div>
    </aside>

    <!-- ══ TOPBAR ══ -->
    <header class="topbar">
        <div class="topbar-breadcrumb">
            <i class="fas fa-house"></i>
            <i class="fas fa-chevron-right"></i>
            <strong>@yield('title', 'Dashboard')</strong>
        </div>
        <div class="topbar-right">
            <div class="topbar-badge">
                <i class="fas fa-calendar-alt" style="font-size:11px;"></i>
                {{ now()->locale('id')->isoFormat('D MMM YYYY') }}
            </div>
        </div>
    </header>

    <!-- ══ MAIN ══ -->
    <div class="main-wrap">
        <div class="page-body">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success', title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 2200, showConfirmButton: false,
            background: '#111827', color: '#f1f5f9', iconColor: '#10b981',
            customClass: { popup: 'swal-dark' }
        });
    </script>
    @endif

</body>
</html>
