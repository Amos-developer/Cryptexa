@extends('admin.layouts.app')

@section('title', 'Lucky Boxes')
@section('page-title', 'Lucky Boxes')
@section('page-description', 'Monitor lucky box claims')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.yellow{background:linear-gradient(135deg,#f093fb,#f5576c)}
.stat-icon.purple{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;margin:0 2px}
.action-btn.edit{background:#fef3c7;color:#92400e}
.action-btn.edit:hover{background:#fde68a}
.action-btn.delete{background:#fee2e2;color:#991b1b}
.action-btn.delete:hover{background:#fecaca}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-top:24px}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.pagination-wrapper{padding:20px 24px;display:flex;justify-content:center}
.pagination{display:flex;gap:8px;list-style:none;padding:0;margin:0}
.pagination li a,.pagination li span{display:block;padding:8px 14px;border-radius:8px;font-size:14px;font-weight:600;transition:all .3s}
.pagination li.active span{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.pagination li:not(.active):not(.disabled) a{background:#f1f5f9;color:#64748b}
.pagination li:not(.active):not(.disabled) a:hover{background:#e2e8f0}
.pagination li.disabled span{background:#f8fafc;color:#cbd5e1}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-gift"></i></div>
        <div class="stat-info">
          <h4>Total Claims</h4>
          <h2>{{ number_format($totalClaims) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-dollar"></i></div>
        <div class="stat-info">
          <h4>Total Rewards</h4>
          <h2>${{ number_format($totalRewards, 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon yellow"><i class="fa fa-calendar-day"></i></div>
        <div class="stat-info">
          <h4>Today's Claims</h4>
          <h2>{{ number_format($todayClaims) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon purple"><i class="fa fa-chart-line"></i></div>
        <div class="stat-info">
          <h4>Avg Reward</h4>
          <h2>${{ number_format($avgReward, 2) }}</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Lucky Box History</h3>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>User</th>
            <th>Reward</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($luckyBoxes as $box)
          <tr>
            <td>#{{ $box->id }}</td>
            <td style="font-weight:600">{{ $box->user->username ?? 'N/A' }}</td>
            <td style="font-weight:700;color:#059669">${{ number_format($box->reward, 2) }}</td>
            <td style="color:#64748b">{{ $box->created_at->format('M d, Y H:i') }}</td>
            <td>
              <a href="{{ route('admin.lucky-boxes.edit', $box) }}" class="action-btn edit" title="Edit">✏️</a>
              <form action="{{ route('admin.lucky-boxes.destroy', $box) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete" title="Delete" onclick="return confirm('Delete this lucky box?')">🗑️</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" style="text-align:center;padding:60px 20px;color:#94a3b8">
              <div style="font-size:64px;margin-bottom:16px;opacity:.5">🎁</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Lucky Box Claims</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($luckyBoxes->hasPages())
    <div class="pagination-wrapper">
      <ul class="pagination">
        @if($luckyBoxes->onFirstPage())
          <li class="disabled"><span>←</span></li>
        @else
          <li><a href="{{ $luckyBoxes->previousPageUrl() }}">←</a></li>
        @endif
        @foreach($luckyBoxes->getUrlRange(1, $luckyBoxes->lastPage()) as $page => $url)
          @if($page == $luckyBoxes->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
        @if($luckyBoxes->hasMorePages())
          <li><a href="{{ $luckyBoxes->nextPageUrl() }}">→</a></li>
        @else
          <li class="disabled"><span>→</span></li>
        @endif
      </ul>
    </div>
    @endif
  </div>
</div>
@endsection
