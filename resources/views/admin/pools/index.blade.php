@extends('admin.layouts.app')

@section('title', 'Vaults')
@section('page-title', 'Vaults')
@section('page-description', 'Manage compute Vaults')

@section('content')
<style>
.stat-box{background:#fff;padding:25px;border-radius:12px;box-shadow:0 2px 10px rgba(0,0,0,.08);display:flex;align-items:center;gap:20px;margin-bottom:20px}
.stat-icon{width:60px;height:60px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;color:#fff}
.stat-icon.blue{background:linear-gradient(135deg,#667eea,#764ba2)}
.stat-icon.green{background:linear-gradient(135deg,#11998e,#38ef7d)}
.stat-icon.red{background:linear-gradient(135deg,#fa709a,#fee140)}
.stat-info h4{margin:0;font-size:14px;color:#888;font-weight:400}
.stat-info h2{margin:5px 0 0;font-size:28px;font-weight:700;color:#333}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,.08);margin-top:24px}
.table-header{padding:20px 24px;border-bottom:2px solid #f1f5f9;display:flex;justify-content:space-between;align-items:center}
.table-title{font-size:20px;font-weight:700;color:#1e293b}
.modern-table{width:100%;border-collapse:separate;border-spacing:0}
.modern-table thead th{background:#f8fafc;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;border-bottom:2px solid #e2e8f0}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;color:#334155}
.modern-table tbody tr:hover{background:#f8fafc}
.action-btn{width:36px;height:36px;border-radius:8px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;justify-content:center;margin:0 2px}
.action-btn.view{background:#dbeafe;color:#1e40af}
.action-btn.view:hover{background:#bfdbfe}
.action-btn.edit{background:#fef3c7;color:#92400e}
.action-btn.edit:hover{background:#fde68a}
.action-btn.delete{background:#fee2e2;color:#991b1b}
.action-btn.delete:hover{background:#fecaca}
.btn-create{padding:10px 20px;border:none;border-radius:10px;font-weight:600;font-size:14px;background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;text-decoration:none;display:inline-block}
.pagination-wrapper{padding:20px 24px;display:flex;justify-content:center}
.pagination{display:flex;gap:8px;list-style:none;padding:0;margin:0}
.pagination li a,.pagination li span{display:block;padding:8px 14px;border-radius:8px;font-size:14px;font-weight:600;transition:all .3s}
.pagination li.active span{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff}
.pagination li:not(.active):not(.disabled) a{background:#f1f5f9;color:#64748b}
.pagination li:not(.active):not(.disabled) a:hover{background:#e2e8f0}
.pagination li.disabled span{background:#f8fafc;color:#cbd5e1}
.empty-state{text-align:center;padding:60px 20px;color:#94a3b8}
.empty-icon{font-size:64px;margin-bottom:16px;opacity:.5}
@media(max-width:768px){
.stat-box{padding:20px}
.stat-info h2{font-size:24px}
.table-card{border-radius:12px}
.modern-table{font-size:13px}
.modern-table thead{display:none}
.modern-table tbody td{display:block;text-align:right;padding:12px 16px;position:relative;padding-left:50%}
.modern-table tbody td:before{content:attr(data-label);position:absolute;left:16px;font-weight:700;color:#64748b;text-align:left}
.modern-table tbody tr{border:2px solid #f1f5f9;border-radius:12px;margin-bottom:12px;display:block}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon blue"><i class="fa fa-database"></i></div>
        <div class="stat-info">
          <h4>Total Vaults</h4>
          <h2>{{ number_format($pools->total()) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon green"><i class="fa fa-dollar"></i></div>
        <div class="stat-info">
          <h4>Total Value</h4>
          <h2>${{ number_format($pools->sum('price'), 2) }}</h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <div class="stat-box">
        <div class="stat-icon red"><i class="fa fa-chart-line"></i></div>
        <div class="stat-info">
          <h4>Avg Daily Profit</h4>
          <h2>{{ number_format($pools->avg('daily_profit'), 2) }}%</h2>
        </div>
      </div>
    </div>
  </div>

  <div class="table-card">
    <div class="table-header">
      <h3 class="table-title">Compute Vaults</h3>
      <a href="{{ route('admin.pools.create') }}" class="btn-create">➕ Create Vault</a>
    </div>
    <div style="overflow-x:auto">
      <table class="modern-table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Type</th>
            <th>Price</th>
            <th>Daily Profit</th>
            <th>Duration</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($pools as $pool)
          <tr>
            <td data-label="#">{{ ($pools->currentPage() - 1) * $pools->perPage() + $loop->iteration }}</td>
            <td data-label="Name" style="font-weight:700;color:#667eea">{{ $pool->name }}</td>
            <td data-label="Type"><code style="background:#f1f5f9;padding:4px 8px;border-radius:6px;font-size:12px">{{ strtoupper($pool->type) }}</code></td>
            <td data-label="Price" style="font-weight:700;color:#059669">${{ number_format($pool->price, 2) }}</td>
            <td data-label="Daily Profit" style="font-weight:700;color:#dc2626">{{ number_format($pool->daily_profit, 2) }}%</td>
            <td data-label="Duration">{{ $pool->duration_minutes }} min</td>
            <td data-label="Actions">
              <a href="{{ route('admin.pools.show', $pool) }}" class="action-btn view" title="View">👁️</a>
              <a href="{{ route('admin.pools.edit', $pool) }}" class="action-btn edit" title="Edit">✏️</a>
              <form action="{{ route('admin.pools.destroy', $pool) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete" title="Delete" onclick="return confirm('Delete this Vault?')">🗑️</button>
              </form>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="empty-state">
              <div class="empty-icon">🏊</div>
              <div style="font-size:18px;font-weight:600;margin-bottom:8px">No Vaults Found</div>
              <div style="font-size:14px">Create your first compute Vault</div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    @if($pools->hasPages())
    <div class="pagination-wrapper">
      <ul class="pagination">
        @if($pools->onFirstPage())
          <li class="disabled"><span>←</span></li>
        @else
          <li><a href="{{ $pools->previousPageUrl() }}">←</a></li>
        @endif
        @foreach($pools->getUrlRange(1, $pools->lastPage()) as $page => $url)
          @if($page == $pools->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
        @if($pools->hasMorePages())
          <li><a href="{{ $pools->nextPageUrl() }}">→</a></li>
        @else
          <li class="disabled"><span>→</span></li>
        @endif
      </ul>
    </div>
    @endif
  </div>
</div>
@endsection
