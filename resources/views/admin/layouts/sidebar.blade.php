<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MAIN NAVIGATION</li>
  
  <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>

  <li class="header">USER MANAGEMENT</li>
  
  <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
    <a href="{{ route('admin.users.index') }}">
      <i class="fa fa-users"></i> <span>Users</span>
    </a>
  </li>

  <li class="header">LIQUIDITY POOLS</li>

  <li class="{{ request()->routeIs('admin.pools.*') ? 'active' : '' }}">
    <a href="{{ route('admin.pools.index') }}">
      <i class="fa fa-database"></i> <span>Pools</span>
    </a>
  </li>

  <li class="{{ request()->routeIs('admin.user-pools.*') ? 'active' : '' }}">
    <a href="{{ route('admin.user-pools.index') }}">
      <i class="fa fa-server"></i> <span>User Pools</span>
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

  <li class="header">REWARDS & BONUSES</li>

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

  <li class="header">GAMIFICATION</li>

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
