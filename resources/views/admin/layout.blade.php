<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        /* === YOUR SITE COLOR SCHEME === */
        .app-dark {
            min-height: 100vh;
            background:
                radial-gradient(circle at top, rgba(56, 189, 248, 0.08), transparent 40%),
                linear-gradient(180deg, #020617 0%, #020617 100%);
            color: #e5e7eb;
            font-family: system-ui, -apple-system, BlinkMacSystemFont;
        }

        /* === LAYOUT === */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .admin-content {
            flex: 1;
            padding: 24px;
        }

        /* === SIDEBAR === */
        .sidebar {
            width: 260px;
            background: rgba(2, 6, 23, 0.9);
            border-right: 1px solid rgba(255, 255, 255, .06);
            padding: 20px;
        }

        .sidebar h2 {
            margin-bottom: 24px;
            font-size: 20px;
            color: #38bdf8;
        }

        .sidebar a {
            display: block;
            padding: 12px 14px;
            border-radius: 8px;
            color: #e5e7eb;
            text-decoration: none;
            margin-bottom: 8px;
            transition: background .2s;
        }

        .sidebar a:hover {
            background: rgba(56, 189, 248, 0.15);
        }

        /* === TOPBAR === */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            background: rgba(2, 6, 23, .8);
            border: 1px solid rgba(255, 255, 255, .06);
            border-radius: 12px;
            margin-bottom: 24px;
        }

        /* === STATS === */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .card {
            background: rgba(2, 6, 23, .9);
            border: 1px solid rgba(255, 255, 255, .06);
            border-radius: 14px;
            padding: 20px;
        }

        .card h3 {
            font-size: 14px;
            color: #9ca3af;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 26px;
            font-weight: bold;
            color: #38bdf8;
        }

        /* === TABLE === */
        .table-wrapper {
            background: rgba(2, 6, 23, .9);
            border: 1px solid rgba(255, 255, 255, .06);
            border-radius: 14px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, .06);
        }

        th {
            font-size: 13px;
            text-transform: uppercase;
            color: #9ca3af;
        }

        /* === STATUS BADGES === */
        .badge {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .badge.pending {
            background: rgba(251, 191, 36, .15);
            color: #fbbf24;
        }

        .badge.completed {
            background: rgba(34, 197, 94, .15);
            color: #22c55e;
        }

        .badge.failed {
            background: rgba(239, 68, 68, .15);
            color: #ef4444;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }
        }
    </style>
</head>

<body class="app-dark">
    <div class="admin-wrapper">

        {{-- Sidebar --}}
        @include('admin.partials.sidebar')

        {{-- Main --}}
        <div class="admin-content app-content">
            @include('admin.partials.topbar')
            @yield('content')
        </div>

    </div>
</body>

</html>