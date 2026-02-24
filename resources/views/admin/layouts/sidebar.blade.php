<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  
  <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>

  <li class="header">MANAGEMENT</li>
  
  <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
    <a href="{{ route('admin.users.index') }}">
      <i class="fa fa-users"></i> <span>Users</span>
    </a>
  </li>

  <li class="header">TRANSACTIONS</li>

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

  <li class="{{ request()->routeIs('admin.pools.*') ? 'active' : '' }}">
    <a href="{{ route('admin.pools.index') }}">
      <i class="fa fa-database"></i> <span>Pools</span>
    </a>
  </li>

  <li class="header">SETTINGS</li>
</ul>
