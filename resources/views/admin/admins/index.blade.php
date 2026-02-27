@extends('admin.layouts.app')

@section('title', 'Admins')
@section('page-title', 'Admins')
@section('page-description', 'Manage Admin Users')

@section('content')
<style>
.header-actions{display:flex;justify-content:space-between;align-items:center;margin-bottom:24px}
.btn-add{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;padding:12px 24px;border:none;border-radius:10px;font-weight:600;font-size:14px;cursor:pointer;text-decoration:none;display:inline-block;transition:.3s}
.btn-add:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,.4)}
.table-card{background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.08)}
.modern-table{width:100%;border-collapse:collapse}
.modern-table thead th{background:#f9fafb;padding:16px 20px;text-align:left;font-size:13px;font-weight:700;color:#6b7280;text-transform:uppercase;border-bottom:2px solid #e5e7eb}
.modern-table tbody td{padding:16px 20px;border-bottom:1px solid #f3f4f6;font-size:14px}
.modern-table tbody tr:hover{background:#f9fafb}
.badge{padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#dbeafe;color:#1e40af}
.btn-delete{background:#fee2e2;color:#991b1b;border:none;padding:8px 16px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;transition:.3s}
.btn-delete:hover{background:#fecaca}
</style>

<div class="header-actions">
  <div></div>
  <a href="{{ route('admin.admins.create') }}" class="btn-add">➕ Add New Admin</a>
</div>

<div class="table-card">
  <table class="modern-table">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Created</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($admins as $admin)
      <tr>
        <td><strong>{{ $admin->username }}</strong></td>
        <td>{{ $admin->email }}</td>
        <td>{{ $admin->created_at->format('M d, Y') }}</td>
        <td>
          @if($admin->id !== auth()->id())
          <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this admin?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">🗑️ Delete</button>
          </form>
          @else
          <span class="badge">Current User</span>
          @endif
        </td>
      </tr>
      @empty
      <tr><td colspan="4" style="text-align:center;padding:40px;color:#9ca3af">No admins found</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

@if($admins->hasPages())
<div style="margin-top:24px;display:flex;justify-content:center">
  {{ $admins->links() }}
</div>
@endif
@endsection
