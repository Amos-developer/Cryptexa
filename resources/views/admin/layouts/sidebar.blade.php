<!-- Sidebar Menu -->
<style>
.sidebar-menu{list-style:none;padding:12px 8px}
.sidebar-menu .header{color:#9ca3af;font-size:10px;padding:20px 16px 8px;font-weight:700;text-transform:uppercase;letter-spacing:1px;display:flex;align-items:center;gap:8px}
.sidebar-menu .header::before{content:'';width:20px;height:2px;background:linear-gradient(90deg,#667eea,transparent)}
.sidebar-menu li a{display:flex;align-items:center;padding:12px 16px;color:#6b7280;text-decoration:none;border-radius:12px;transition:all .3s;font-size:14px;font-weight:500;margin-bottom:4px;position:relative;overflow:hidden}
.sidebar-menu li a::before{content:'';position:absolute;left:0;top:0;bottom:0;width:3px;background:linear-gradient(135deg,#667eea,#764ba2);transform:scaleY(0);transition:.3s}
.sidebar-menu li a:hover{background:#f3f4f6;color:#667eea;padding-left:20px}
.sidebar-menu li a:hover::before{transform:scaleY(1)}
.sidebar-menu li.active a{background:linear-gradient(135deg,rgba(102,126,234,.1),rgba(118,75,162,.1));color:#667eea;font-weight:600;border-left:3px solid #667eea;padding-left:20px}
.sidebar-menu li a i{margin-right:12px;width:20px;font-size:16px;text-align:center;transition:.3s}
.sidebar-menu li.active a i{transform:scale(1.1)}
@media(max-width:768px){
.sidebar-menu{padding:8px 4px}
.sidebar-menu .header{font-size:9px;padding:16px 12px 6px}
.sidebar-menu li a{padding:10px 12px;font-size:13px}
.sidebar-menu li a i{font-size:14px}
}
</style>

<ul class="sidebar-menu">
  <!-- MAIN -->
  <li class="header">📊 MAIN</li>
  <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>

  <!-- USERS -->
  <li class="header">👥 USERS</li>
  <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
    <a href="{{ route('admin.users.index') }}">
      <i class="fa fa-users"></i> <span>Manage Users</span>
    </a>
  </li>

  <!-- POOLS -->
  <li class="header">💧 LIQUIDITY POOLS</li>
  <li class="{{ request()->routeIs('admin.pools.*') ? 'active' : '' }}">
    <a href="{{ route('admin.pools.index') }}">
      <i class="fa fa-database"></i> <span>Pool Plans</span>
    </a>
  </li>
  <li class="{{ request()->routeIs('admin.user-pools.*') ? 'active' : '' }}">
    <a href="{{ route('admin.user-pools.index') }}">
      <i class="fa fa-server"></i> <span>Active Pools</span>
    </a>
  </li>

  <!-- TRANSACTIONS -->
  <li class="header">💰 TRANSACTIONS</li>
  <li class="{{ request()->routeIs('admin.deposits.*') ? 'active' : '' }}">
    <a href="{{ route('admin.deposits.index') }}">
      <i class="fa fa-arrow-down"></i> <span>Deposits</span>
    </a>
  </li>
  <li class="{{ request()->routeIs('admin.withdrawals.*') ? 'active' : '' }}">
    <a href="{{ route('admin.withdrawals.index') }}">
      <i class="fa fa-arrow-up"></i> <span>Withdrawals</span>
    </a>
  </li>

  <!-- REWARDS -->
  <li class="header">🎁 REWARDS</li>
  <li class="{{ request()->routeIs('admin.commissions.*') ? 'active' : '' }}">
    <a href="{{ route('admin.commissions.index') }}">
      <i class="fa fa-percent"></i> <span>Commissions</span>
    </a>
  </li>
  <li class="{{ request()->routeIs('admin.rank-bonuses.*') ? 'active' : '' }}">
    <a href="{{ route('admin.rank-bonuses.index') }}">
      <i class="fa fa-trophy"></i> <span>Rank Bonuses</span>
    </a>
  </li>

  <!-- ENGAGEMENT -->
  <li class="header">🎮 ENGAGEMENT</li>
  <li class="{{ request()->routeIs('admin.checkins.*') ? 'active' : '' }}">
    <a href="{{ route('admin.checkins.index') }}">
      <i class="fa fa-check-circle"></i> <span>Check-ins</span>
    </a>
  </li>
  <li class="{{ request()->routeIs('admin.lucky-boxes.*') ? 'active' : '' }}">
    <a href="{{ route('admin.lucky-boxes.index') }}">
      <i class="fa fa-gift"></i> <span>Lucky Boxes</span>
    </a>
  </li>
</ul>
