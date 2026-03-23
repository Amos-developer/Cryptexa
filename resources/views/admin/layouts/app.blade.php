<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'Admin Panel') | Cryptexa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <style>
  *{margin:0;padding:0;box-sizing:border-box}
  body{font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;background:#f8f9fa}
  
  /* Header */
  .header{position:fixed;top:0;left:0;right:0;height:65px;background:#fff;border-bottom:1px solid #e5e7eb;display:flex;align-items:center;padding:0 24px;z-index:1000;box-shadow:0 1px 3px rgba(0,0,0,.05)}
  .menu-toggle{display:none;background:none;border:none;font-size:24px;color:#667eea;cursor:pointer;margin-right:16px}
  .logo{font-size:22px;font-weight:700;background:linear-gradient(135deg,#667eea,#764ba2);-webkit-background-clip:text;-webkit-text-fill-color:transparent;text-decoration:none;margin-right:auto}
  .user-menu{display:flex;align-items:center;gap:12px;padding:8px 16px;border-radius:10px;background:#f8f9fa;transition:.3s}
  .user-menu:hover{background:#e5e7eb}
  .user-avatar{width:38px;height:38px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:600;font-size:14px}
  .user-name{font-size:14px;font-weight:600;color:#1f2937}
  .logout-btn{background:none;border:none;color:#6b7280;cursor:pointer;font-size:18px;padding:8px;border-radius:8px;transition:.3s}
  .logout-btn:hover{background:#fee2e2;color:#dc2626}
  
  /* Sidebar */
  .sidebar{position:fixed;left:0;top:65px;bottom:0;width:260px;background:#fff;border-right:1px solid #e5e7eb;overflow-y:auto;z-index:999;transition:.3s}
  .sidebar::-webkit-scrollbar{width:6px}
  .sidebar::-webkit-scrollbar-thumb{background:#d1d5db;border-radius:3px}
  .sidebar-menu{list-style:none;padding:16px 12px}
  .sidebar-menu .header{background:transparent;color:#9ca3af;font-size:11px;padding:16px 12px 8px;font-weight:700;text-transform:uppercase;letter-spacing:.5px}
  .sidebar-menu li a{display:flex;align-items:center;padding:12px 16px;color:#6b7280;text-decoration:none;border-radius:10px;transition:.3s;font-size:14px;font-weight:500}
  .sidebar-menu li a:hover{background:#f3f4f6;color:#667eea}
  .sidebar-menu li.active a{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;box-shadow:0 4px 12px rgba(102,126,234,.3)}
  .sidebar-menu li a i{margin-right:12px;width:20px;font-size:16px;text-align:center}
  
  /* Content */
  .content{margin-left:260px;margin-top:65px;padding:32px;min-height:calc(100vh - 65px)}
  .page-header{margin-bottom:32px}
  .page-header h1{font-size:32px;color:#1f2937;margin-bottom:4px;font-weight:700}
  .page-header small{color:#6b7280;font-size:15px;font-weight:400}
  
  /* Alerts */
  .alert{padding:16px 20px;border-radius:12px;margin-bottom:24px;display:flex;align-items:center;gap:12px;box-shadow:0 2px 8px rgba(0,0,0,.08)}
  .alert-success{background:#d1fae5;color:#065f46;border-left:4px solid #10b981}
  .alert-danger{background:#fee2e2;color:#991b1b;border-left:4px solid #ef4444}
  .alert .close{margin-left:auto;background:none;border:none;font-size:20px;cursor:pointer;color:inherit;opacity:.6;transition:.3s}
  .alert .close:hover{opacity:1}
  
  /* Mobile */
  @media(max-width:768px){
    .menu-toggle{display:block}
    .sidebar{transform:translateX(-100%)}
    .sidebar.open{transform:translateX(0);box-shadow:4px 0 12px rgba(0,0,0,.1)}
    .content{margin-left:0;padding:20px}
    .page-header h1{font-size:24px}
    .user-name{display:none}
  }
  </style>
  @stack('styles')
</head>
<body>
  <div class="header">
    <button class="menu-toggle" onclick="document.querySelector('.sidebar').classList.toggle('open')">☰</button>
    <a href="{{ route('admin.dashboard') }}" class="logo">Cryptexa</a>
    <div class="user-menu">
      <div class="user-avatar">{{ strtoupper(substr(Auth::user()->username ?? 'A', 0, 1)) }}</div>
      <span class="user-name">{{ Auth::user()->username ?? 'Admin' }}</span>
      <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="logout-btn" title="Logout"><i class="fa fa-sign-out"></i></button>
      </form>
    </div>
  </div>

  <div class="sidebar">
    @include('admin.layouts.sidebar')
  </div>

  <div class="content">
    <div class="page-header">
      <h1>@yield('page-title', 'Dashboard') <small>@yield('page-description', '')</small></h1>
    </div>

    @if(session('success'))
      <div class="alert alert-success">
        <button type="button" class="close" onclick="this.parentElement.style.display='none'">&times;</button>
        {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">
        <button type="button" class="close" onclick="this.parentElement.style.display='none'">&times;</button>
        {{ session('error') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <button type="button" class="close" onclick="this.parentElement.style.display='none'">&times;</button>
        <ul style="margin:10px 0 0 20px">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')
  </div>

  @stack('scripts')
</body>
</html>
