<!-- Sidebar Menu -->
<style>
.sidebar-menu .header{cursor:pointer;user-select:none;position:relative}
.sidebar-menu .header::after{content:'▼';position:absolute;right:12px;font-size:8px;transition:.3s}
.sidebar-menu .header.collapsed::after{transform:rotate(-90deg)}
.sidebar-category{max-height:1000px;overflow:hidden;transition:max-height .3s ease}
.sidebar-category.collapsed{max-height:0}
@media(max-width:768px){
.sidebar-category:not(.open){max-height:0}
.sidebar-category.open{max-height:1000px}
}
</style>

<ul class="sidebar-menu">
  <li class="header" onclick="toggleCat(this)">📊 MAIN</li>
  <div class="sidebar-category open">
    <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
  </div>

  <li class="header" onclick="toggleCat(this)">👥 USERS</li>
  <div class="sidebar-category open">
    <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
      <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> Manage Users</a>
    </li>
  </div>

  <li class="header" onclick="toggleCat(this)">💧 LIQUIDITY POOLS</li>
  <div class="sidebar-category open">
    <li class="{{ request()->routeIs('admin.pools.*') ? 'active' : '' }}">
      <a href="{{ route('admin.pools.index') }}"><i class="fa fa-database"></i> Pool Plans</a>
    </li>
    <li class="{{ request()->routeIs('admin.user-pools.*') ? 'active' : '' }}">
      <a href="{{ route('admin.user-pools.index') }}"><i class="fa fa-server"></i> Active Pools</a>
    </li>
  </div>

  <li class="header" onclick="toggleCat(this)">💰 TRANSACTIONS</li>
  <div class="sidebar-category open">
    <li class="{{ request()->routeIs('admin.deposits.*') ? 'active' : '' }}">
      <a href="{{ route('admin.deposits.index') }}"><i class="fa fa-arrow-down"></i> Deposits</a>
    </li>
    <li class="{{ request()->routeIs('admin.withdrawals.*') ? 'active' : '' }}">
      <a href="{{ route('admin.withdrawals.index') }}"><i class="fa fa-arrow-up"></i> Withdrawals</a>
    </li>
  </div>

  <li class="header" onclick="toggleCat(this)">🎁 REWARDS</li>
  <div class="sidebar-category open">
    <li class="{{ request()->routeIs('admin.rewards.*') ? 'active' : '' }}">
      <a href="{{ route('admin.rewards.index') }}"><i class="fa fa-gift"></i> Overview</a>
    </li>
    <li class="{{ request()->routeIs('admin.commissions.*') ? 'active' : '' }}">
      <a href="{{ route('admin.commissions.index') }}"><i class="fa fa-dollar"></i> Commissions</a>
    </li>
    <li class="{{ request()->routeIs('admin.rank-bonuses.*') ? 'active' : '' }}">
      <a href="{{ route('admin.rank-bonuses.index') }}"><i class="fa fa-trophy"></i> Rank Bonuses</a>
    </li>
    <li class="{{ request()->routeIs('admin.checkins.*') ? 'active' : '' }}">
      <a href="{{ route('admin.checkins.index') }}"><i class="fa fa-check-circle"></i> Check-ins</a>
    </li>
    <li class="{{ request()->routeIs('admin.lucky-boxes.*') ? 'active' : '' }}">
      <a href="{{ route('admin.lucky-boxes.index') }}"><i class="fa fa-cube"></i> Lucky Boxes</a>
    </li>
  </div>

  <li class="header" onclick="toggleCat(this)">⚙️ SYSTEM</li>
  <div class="sidebar-category open">
    <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
      <a href="{{ route('admin.settings.index') }}"><i class="fa fa-cog"></i> Settings</a>
    </li>
  </div>
</ul>

<script>
function toggleCat(h) {
  const c = h.nextElementSibling;
  const isOpen = c.classList.contains('open');
  if (window.innerWidth <= 768) {
    document.querySelectorAll('.sidebar-category').forEach(cat => cat.classList.remove('open'));
  }
  h.classList.toggle('collapsed');
  c.classList.toggle('collapsed');
  if (!isOpen) c.classList.add('open');
  else c.classList.remove('open');
}
</script>
