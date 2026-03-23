@extends('admin.layouts.app')

@section('title', 'Rewards')
@section('page-title', 'Rewards')
@section('page-description', 'Manage Commissions, Bonuses & Engagement')

@section('content')
<style>
.tabs{display:flex;gap:8px;margin-bottom:24px;border-bottom:2px solid #e5e7eb;overflow-x:auto}
.tab{padding:12px 24px;background:none;border:none;font-size:14px;font-weight:600;color:#6b7280;cursor:pointer;border-bottom:3px solid transparent;transition:.3s;white-space:nowrap}
.tab.active{color:#667eea;border-bottom-color:#667eea}
.tab-content{display:none}
.tab-content.active{display:block}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.08)}
.modern-table{width:100%;border-collapse:collapse}
.modern-table thead th{background:#f9fafb;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#6b7280;text-transform:uppercase;border-bottom:2px solid #e5e7eb}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f3f4f6;font-size:14px}
.modern-table tbody tr:hover{background:#f9fafb}
.badge{padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600}
.badge.success{background:#d1fae5;color:#065f46}
.badge.pending{background:#fef3c7;color:#92400e}
.empty{text-align:center;padding:60px 20px;color:#9ca3af}
.btn-delete{background:#fee2e2;color:#991b1b;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;font-size:12px;font-weight:600;transition:.3s}
.btn-delete:hover{background:#fecaca}
.pagination{display:flex;gap:8px;list-style:none;padding:20px;margin:0;justify-content:center}
.pagination li a,.pagination li span{display:block;padding:8px 14px;border-radius:8px;font-size:14px;font-weight:600;transition:all .3s;text-decoration:none}
.pagination li.active span{background:#667eea;color:#fff}
.pagination li:not(.active):not(.disabled) a{background:#f1f5f9;color:#64748b}
.pagination li:not(.active):not(.disabled) a:hover{background:#e2e8f0}
.pagination li.disabled span{background:#f8fafc;color:#cbd5e1}
</style>

<div class="tabs">
  <button class="tab active" onclick="switchTab('commissions')">💰 Commissions</button>
  <button class="tab" onclick="switchTab('rank-bonuses')">🏆 Rank Bonuses</button>
  <button class="tab" onclick="switchTab('checkins')">✅ Check-ins</button>
  <button class="tab" onclick="switchTab('lucky-boxes')">🎁 Lucky Boxes</button>
</div>

<div id="commissions" class="tab-content active">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Recent Commissions</h3>
    </div>
    <div class="table-scroll">
    <table class="modern-table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>From User</th>
          <th>Level</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($commissions as $index => $commission)
        <tr>
          <td data-label="#">{{ $commissions->firstItem() + $index }}</td>
          <td data-label="User"><strong>{{ $commission->fromUser->username ?? 'N/A' }}</strong></td>
          <td data-label="From User">{{ $commission->user->username ?? 'N/A' }}</td>
          <td data-label="Level"><span class="badge pending">Level {{ $commission->level }}</span></td>
          <td data-label="Amount" style="font-weight:700;color:#059669">${{ number_format($commission->amount, 2) }}</td>
          <td data-label="Date">{{ $commission->created_at->format('M d, Y H:i') }}</td>
        </tr>
        @empty
        <tr><td colspan="6" class="empty">No commissions found</td></tr>
        @endforelse
      </tbody>
    </table>
    </div>
    @if($commissions->hasPages())
    <ul class="pagination">
      @if($commissions->onFirstPage())
        <li class="disabled"><span>←</span></li>
      @else
        <li><a href="{{ $commissions->appends(request()->except('commissions_page'))->previousPageUrl() }}">←</a></li>
      @endif
      @foreach($commissions->getUrlRange(1, $commissions->lastPage()) as $page => $url)
        @if($page == $commissions->currentPage())
          <li class="active"><span>{{ $page }}</span></li>
        @else
          <li><a href="{{ $commissions->appends(request()->except('commissions_page'))->url($page) }}">{{ $page }}</a></li>
        @endif
      @endforeach
      @if($commissions->hasMorePages())
        <li><a href="{{ $commissions->appends(request()->except('commissions_page'))->nextPageUrl() }}">→</a></li>
      @else
        <li class="disabled"><span>→</span></li>
      @endif
    </ul>
    @endif
  </div>
</div>

<div id="rank-bonuses" class="tab-content">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Rank Bonuses</h3>
    </div>
    <div class="table-scroll">
    <table class="modern-table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Rank</th>
          <th>Bonus Amount</th>
          <th>Balance Before</th>
          <th>Balance After</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($rankBonuses as $index => $bonus)
        <tr>
          <td data-label="#">{{ $rankBonuses->firstItem() + $index }}</td>
          <td data-label="User"><strong>{{ $bonus->user->username ?? 'N/A' }}</strong></td>
          <td data-label="Rank"><span class="badge success">{{ $bonus->rank }}</span></td>
          <td data-label="Bonus Amount" style="font-weight:700;color:#059669">${{ number_format($bonus->bonus_amount, 2) }}</td>
          <td data-label="Balance Before" style="color:#6b7280">${{ number_format($bonus->balance_before, 2) }}</td>
          <td data-label="Balance After" style="color:#059669;font-weight:600">${{ number_format($bonus->balance_after, 2) }}</td>
          <td data-label="Date">{{ $bonus->created_at->format('M d, Y H:i') }}</td>
          <td data-label="Actions">
            <a href="{{ route('admin.rank-bonuses.edit', ['rank_bonus' => $bonus->id, 'page' => request('rankbonuses_page', 1)]) }}" style="padding:6px 12px;background:#fef3c7;color:#92400e;border-radius:6px;text-decoration:none;font-size:12px;font-weight:600;margin-right:4px">✏️</a>
            <form action="{{ route('admin.rank-bonuses.destroy', $bonus->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this rank bonus?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-delete">🗑️</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="empty">No rank bonuses found</td></tr>
        @endforelse
      </tbody>
    </table>
    </div>
    @if($rankBonuses->hasPages())
    <ul class="pagination">
      @if($rankBonuses->onFirstPage())
        <li class="disabled"><span>←</span></li>
      @else
        <li><a href="{{ $rankBonuses->appends(request()->except('rankbonuses_page'))->previousPageUrl() }}">←</a></li>
      @endif
      @foreach($rankBonuses->getUrlRange(1, $rankBonuses->lastPage()) as $page => $url)
        @if($page == $rankBonuses->currentPage())
          <li class="active"><span>{{ $page }}</span></li>
        @else
          <li><a href="{{ $rankBonuses->appends(request()->except('rankbonuses_page'))->url($page) }}">{{ $page }}</a></li>
        @endif
      @endforeach
      @if($rankBonuses->hasMorePages())
        <li><a href="{{ $rankBonuses->appends(request()->except('rankbonuses_page'))->nextPageUrl() }}">→</a></li>
      @else
        <li class="disabled"><span>→</span></li>
      @endif
    </ul>
    @endif
  </div>
</div>

<div id="checkins" class="tab-content">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Recent Check-ins</h3>
    </div>
    <div class="table-scroll">
    <table class="modern-table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Day</th>
          <th>Reward</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($checkins as $index => $checkin)
        <tr>
          <td data-label="#">{{ $checkins->firstItem() + $index }}</td>
          <td data-label="User"><strong>{{ $checkin->user->username ?? 'N/A' }}</strong></td>
          <td data-label="Day"><span class="badge pending">Day {{ $checkin->day }}</span></td>
          <td data-label="Reward" style="font-weight:700;color:#059669">${{ number_format($checkin->reward, 2) }}</td>
          <td data-label="Date">{{ $checkin->created_at->format('M d, Y H:i') }}</td>
        </tr>
        @empty
        <tr><td colspan="5" class="empty">No check-ins found</td></tr>
        @endforelse
      </tbody>
    </table>
    </div>
    @if($checkins->hasPages())
    <ul class="pagination">
      @if($checkins->onFirstPage())
        <li class="disabled"><span>←</span></li>
      @else
        <li><a href="{{ $checkins->appends(request()->except('checkins_page'))->previousPageUrl() }}">←</a></li>
      @endif
      @foreach($checkins->getUrlRange(1, $checkins->lastPage()) as $page => $url)
        @if($page == $checkins->currentPage())
          <li class="active"><span>{{ $page }}</span></li>
        @else
          <li><a href="{{ $checkins->appends(request()->except('checkins_page'))->url($page) }}">{{ $page }}</a></li>
        @endif
      @endforeach
      @if($checkins->hasMorePages())
        <li><a href="{{ $checkins->appends(request()->except('checkins_page'))->nextPageUrl() }}">→</a></li>
      @else
        <li class="disabled"><span>→</span></li>
      @endif
    </ul>
    @endif
  </div>
</div>

<div id="lucky-boxes" class="tab-content">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Recent Lucky Boxes</h3>
    </div>
    <div class="table-scroll">
    <table class="modern-table">
      <thead>
        <tr>
          <th>#</th>
          <th>User</th>
          <th>Reward</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        @forelse($luckyBoxes as $index => $box)
        <tr>
          <td data-label="#">{{ $luckyBoxes->firstItem() + $index }}</td>
          <td data-label="User"><strong>{{ $box->user->username ?? 'N/A' }}</strong></td>
          <td data-label="Reward" style="font-weight:700;color:#059669">${{ number_format($box->reward, 2) }}</td>
          <td data-label="Date">{{ $box->created_at->format('M d, Y H:i') }}</td>
        </tr>
        @empty
        <tr><td colspan="4" class="empty">No lucky box rewards found</td></tr>
        @endforelse
      </tbody>
    </table>
    </div>
    @if($luckyBoxes->hasPages())
    <ul class="pagination">
      @if($luckyBoxes->onFirstPage())
        <li class="disabled"><span>←</span></li>
      @else
        <li><a href="{{ $luckyBoxes->appends(request()->except('luckyboxes_page'))->previousPageUrl() }}">←</a></li>
      @endif
      @foreach($luckyBoxes->getUrlRange(1, $luckyBoxes->lastPage()) as $page => $url)
        @if($page == $luckyBoxes->currentPage())
          <li class="active"><span>{{ $page }}</span></li>
        @else
          <li><a href="{{ $luckyBoxes->appends(request()->except('luckyboxes_page'))->url($page) }}">{{ $page }}</a></li>
        @endif
      @endforeach
      @if($luckyBoxes->hasMorePages())
        <li><a href="{{ $luckyBoxes->appends(request()->except('luckyboxes_page'))->nextPageUrl() }}">→</a></li>
      @else
        <li class="disabled"><span>→</span></li>
      @endif
    </ul>
    @endif
  </div>
</div>

<script>
function switchTab(tab) {
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
  event.target.classList.add('active');
  document.getElementById(tab).classList.add('active');
}

const urlParams = new URLSearchParams(window.location.search);
let activeTab = 'commissions';
if (urlParams.has('checkins_page')) activeTab = 'checkins';
else if (urlParams.has('luckyboxes_page')) activeTab = 'lucky-boxes';
else if (urlParams.has('rankbonuses_page')) activeTab = 'rank-bonuses';
else if (urlParams.has('commissions_page')) activeTab = 'commissions';

if (activeTab !== 'commissions') {
  document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
  document.querySelector(`[onclick="switchTab('${activeTab}')"]`).classList.add('active');
  document.getElementById(activeTab).classList.add('active');
}
</script>
@endsection
