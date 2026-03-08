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
</style>

<div class="tabs">
  <button class="tab active" onclick="switchTab('commissions')">💰 Commissions</button>
  <button class="tab" onclick="switchTab('rank-bonuses')">🏆 Rank Bonuses</button>
  <button class="tab" onclick="switchTab('checkins')">✅ Check-ins</button>
  <button class="tab" onclick="switchTab('lucky-boxes')">🎁 Lucky Boxes</button>
</div>

<div id="commissions" class="tab-content active">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Recent Commissions</h3>
      <a href="{{ route('admin.commissions.index') }}" style="padding:10px 20px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px">View All</a>
    </div>
    <table class="modern-table">
      <thead>
        <tr>
          <th>User</th>
          <th>From User</th>
          <th>Level</th>
          <th>Amount</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($commissions as $commission)
        <tr>
          <td><strong>{{ $commission->fromUser->username ?? 'N/A' }}</strong></td>
          <td>{{ $commission->user->username ?? 'N/A' }}</td>
          <td><span class="badge pending">Level {{ $commission->level }}</span></td>
          <td style="font-weight:700;color:#059669">${{ number_format($commission->amount, 2) }}</td>
          <td>{{ $commission->created_at->format('M d, Y H:i') }}</td>
          <td>
            <a href="{{ route('admin.commissions.edit', $commission->id) }}" style="padding:6px 12px;background:#fef3c7;color:#92400e;border-radius:6px;text-decoration:none;font-size:12px;font-weight:600;margin-right:4px">✏️</a>
            <form action="{{ route('admin.commissions.destroy', $commission->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this commission?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-delete">🗑️</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="6" class="empty">No commissions found</td></tr>
        @endforelse
      </tbody>
    </table>
    @if($commissions->hasPages())
    <div style="padding:20px;display:flex;justify-content:center">
      {{ $commissions->appends(['tab' => 'commissions'])->links() }}
    </div>
    @endif
  </div>
</div>

<div id="rank-bonuses" class="tab-content">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Rank Bonuses</h3>
      <a href="{{ route('admin.rank-bonuses.index') }}" style="padding:10px 20px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px">View All</a>
    </div>
    <div class="empty" style="padding:80px 20px">
      <div style="font-size:48px;margin-bottom:16px">🏆</div>
      <div style="font-size:16px;font-weight:600;color:#6b7280">Rank Bonuses</div>
      <div style="font-size:14px;color:#9ca3af;margin-top:8px">Manage user rank achievements</div>
    </div>
  </div>
</div>

<div id="checkins" class="tab-content">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Recent Check-ins</h3>
      <a href="{{ route('admin.checkins.index') }}" style="padding:10px 20px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px">View All</a>
    </div>
    <table class="modern-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Day</th>
          <th>Reward</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($checkins as $checkin)
        <tr>
          <td><strong>{{ $checkin->user->username ?? 'N/A' }}</strong></td>
          <td><span class="badge pending">Day {{ $checkin->day }}</span></td>
          <td style="font-weight:700;color:#059669">${{ number_format($checkin->reward, 2) }}</td>
          <td>{{ $checkin->created_at->format('M d, Y H:i') }}</td>
          <td>
            <a href="{{ route('admin.checkins.edit', $checkin->id) }}" style="padding:6px 12px;background:#fef3c7;color:#92400e;border-radius:6px;text-decoration:none;font-size:12px;font-weight:600;margin-right:4px">✏️</a>
            <form action="{{ route('admin.checkins.destroy', $checkin->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this check-in?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-delete">🗑️</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="5" class="empty">No check-ins found</td></tr>
        @endforelse
      </tbody>
    </table>
    @if($checkins->hasPages())
    <div style="padding:20px;display:flex;justify-content:center">
      {{ $checkins->appends(['tab' => 'checkins'])->links() }}
    </div>
    @endif
  </div>
</div>

<div id="lucky-boxes" class="tab-content">
  <div class="table-card">
    <div style="padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center">
      <h3 style="margin:0;font-size:20px;font-weight:700;color:#1e293b">Recent Lucky Boxes</h3>
      <a href="{{ route('admin.lucky-boxes.index') }}" style="padding:10px 20px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;border-radius:8px;text-decoration:none;font-weight:600;font-size:14px">View All</a>
    </div>
    <table class="modern-table">
      <thead>
        <tr>
          <th>User</th>
          <th>Reward</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($luckyBoxes as $box)
        <tr>
          <td><strong>{{ $box->user->username ?? 'N/A' }}</strong></td>
          <td style="font-weight:700;color:#059669">${{ number_format($box->reward, 2) }}</td>
          <td>{{ $box->created_at->format('M d, Y H:i') }}</td>
          <td>
            <a href="{{ route('admin.lucky-boxes.edit', $box->id) }}" style="padding:6px 12px;background:#fef3c7;color:#92400e;border-radius:6px;text-decoration:none;font-size:12px;font-weight:600;margin-right:4px">✏️</a>
            <form action="{{ route('admin.lucky-boxes.destroy', $box->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this lucky box?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-delete">🗑️</button>
            </form>
          </td>
        </tr>
        @empty
        <tr><td colspan="4" class="empty">No lucky box rewards found</td></tr>
        @endforelse
      </tbody>
    </table>
    @if($luckyBoxes->hasPages())
    <div style="padding:20px;display:flex;justify-content:center">
      {{ $luckyBoxes->appends(['tab' => 'lucky-boxes'])->links() }}
    </div>
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
</script>
@endsection
