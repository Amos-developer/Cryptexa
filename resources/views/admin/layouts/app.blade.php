<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Cryptexa Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">Cryptexa</a>
            </div>
            
            <ul class="sidebar-menu">
                <li class="menu-header">Main</li>
                <li class="menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line menu-icon"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="menu-header">Management</li>
                <li class="menu-item">
                    <a href="{{ route('admin.users.index') }}" class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users menu-icon"></i>
                        <span>Users</span>
                    </a>
                </li>
                
                <li class="menu-header">Transactions</li>
                <li class="menu-item">
                    <a href="{{ route('admin.deposits.index') }}" class="menu-link {{ request()->routeIs('admin.deposits.*') ? 'active' : '' }}">
                        <i class="fas fa-arrow-down menu-icon"></i>
                        <span>Deposits</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.withdrawals.index') }}" class="menu-link {{ request()->routeIs('admin.withdrawals.*') ? 'active' : '' }}">
                        <i class="fas fa-arrow-up menu-icon"></i>
                        <span>Withdrawals</span>
                    </a>
                </li>
            </ul>
        </aside>
        
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>
        
        <!-- Main Content -->
        <main class="admin-main" id="mainContent">
            <!-- Top Bar -->
            <div class="admin-topbar">
                <div class="topbar-left">
                    <button class="menu-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
                </div>
                <div class="topbar-right">
                    <div class="topbar-user">
                        <img src="{{ asset('images/avt/avt2.jpg') }}" alt="Admin" class="user-avatar">
                        <span class="user-name">{{ auth()->user()->name }}</span>
                    </div>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-home"></i> Main Site
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Content -->
            <div class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('mobile-visible');
            overlay.classList.toggle('active');
        }
    </script>
    @stack('scripts')
</body>
</html>
