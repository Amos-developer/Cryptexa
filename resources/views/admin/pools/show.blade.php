@extends('admin.layouts.app')

@section('title', 'Vault Details')
@section('page-title', 'Vault Details')
@section('page-description', 'View Vault information')

@section('content')
<style>
@media (prefers-color-scheme: dark){:root{--bg-card:#1e293b;--text-primary:#e2e8f0;--text-secondary:#94a3b8;--border-color:#334155}}
@media (prefers-color-scheme: light){:root{--bg-card:#fff;--text-primary:#1e293b;--text-secondary:#64748b;--border-color:#e2e8f0}}
.detail-card{background:var(--bg-card);border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,.08);max-width:800px;margin:0 auto}
.card-header{text-align:center;margin-bottom:32px}
.card-icon{width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:inline-flex;align-items:center;justify-content:center;font-size:36px;margin-bottom:16px;box-shadow:0 8px 24px rgba(102,126,234,.3)}
.card-title{font-size:28px;font-weight:700;color:var(--text-primary);margin-bottom:8px}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:24px;margin-bottom:32px}
.info-item{padding:20px;background:#f8fafc;border-radius:12px}
.info-label{font-size:12px;color:var(--text-secondary);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px}
.info-value{font-size:18px;font-weight:700;color:var(--text-primary)}
.actions{display:flex;gap:12px;padding-top:24px;border-top:2px solid var(--border-color)}
.btn{flex:1;padding:14px 24px;border:none;border-radius:10px;font-weight:600;font-size:15px;cursor:pointer;transition:all .3s;text-decoration:none;text-align:center}
.btn-back{background:#f1f5f9;color:#64748b}
.btn-back:hover{background:#e2e8f0}
.btn-edit{background:linear-gradient(135deg,#f59e0b,#d97706);color:#fff}
.btn-delete{background:linear-gradient(135deg,#f093fb,#f5576c);color:#fff}
@media (prefers-color-scheme: dark){.info-item{background:#334155}.btn-back{background:#334155;color:#e2e8f0}}
@media(max-width:768px){
.info-grid{grid-template-columns:1fr}
.actions{flex-direction:column}
}
</style>

<div class="container-fluid" style="padding:20px">
  <div class="detail-card">
    <div class="card-header">
      <div class="card-icon">🏊</div>
      <h2 class="card-title">{{ $pool->name }}</h2>
    </div>

    <div class="info-grid">
      <div class="info-item">
        <div class="info-label">🆔 Vault ID</div>
        <div class="info-value">#{{ $pool->id }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">🏷️ Type</div>
        <div class="info-value">{{ strtoupper($pool->type) }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">💵 Price</div>
        <div class="info-value" style="color:#059669">${{ number_format($pool->price, 2) }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">📈 Daily Profit</div>
        <div class="info-value" style="color:#dc2626">{{ number_format($pool->daily_profit, 2) }}%</div>
      </div>
      <div class="info-item">
        <div class="info-label">⏱️ Duration</div>
        <div class="info-value">{{ $pool->duration_minutes }} minutes</div>
      </div>
      <div class="info-item">
        <div class="info-label">📅 Created At</div>
        <div class="info-value" style="font-size:16px">{{ $pool->created_at ? $pool->created_at->format('M d, Y H:i') : '-' }}</div>
      </div>
      <div class="info-item">
        <div class="info-label">🕐 Updated At</div>
        <div class="info-value" style="font-size:16px">{{ $pool->updated_at ? $pool->updated_at->format('M d, Y H:i') : '-' }}</div>
      </div>
    </div>

    <div class="actions">
      <a href="{{ route('admin.pools.index') }}" class="btn btn-back">← Back to List</a>
      <a href="{{ route('admin.pools.edit', $pool) }}" class="btn btn-edit">✏️ Edit</a>
      <form action="{{ route('admin.pools.destroy', $pool) }}" method="POST" style="flex:1">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete" style="width:100%" onclick="return confirm('Delete this Vault?')">🗑️ Delete</button>
      </form>
    </div>
  </div>
</div>
@endsection
