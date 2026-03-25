@extends('layouts.app')

@section('title', 'Notifications | Cryptexa')

@section('hide-header', true)
@section('page-heading', 'Notifications')

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<!-- HEADER BAR -->
<div class="team-header">
    <a href="{{ url()->previous() }}" class="back-btn">
        <i class="icon-left-btn"></i>
    </a>
    <h6 class="header-title">Notifications</h6>
    <span class="placeholder"></span>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container" style="max-width: 600px; margin: 0 auto;">

        @if($notifications->isNotEmpty())
        <div style="display: flex; justify-content: flex-end; margin-bottom: 16px;">
            <button onclick="markAllRead()" style="background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.2); color: #38bdf8; font-size: 13px; cursor: pointer; font-weight: 600; padding: 8px 16px; border-radius: 8px; transition: all 0.3s ease;" onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.08)'; this.style.borderColor='rgba(56,189,248,0.3)'" onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))'; this.style.borderColor='rgba(56,189,248,0.2)'">
                ✓ Mark all as read
            </button>
        </div>
        @endif

        @forelse($notifications as $notification)
        <div class="notification-item" data-id="{{ $notification->id }}" 
            style="
                background: linear-gradient(135deg, rgba(56,189,248,{{ $notification->is_read ? '0.03' : '0.08' }}) 0%, rgba(56,189,248,0.02) 100%);
                border: 1px solid rgba(56,189,248,{{ $notification->is_read ? '0.1' : '0.2' }});
                border-radius: 14px;
                padding: 16px;
                margin-bottom: 12px;
                transition: all 0.3s ease;
                cursor: pointer;
                position: relative;
            "
            onclick="markAsRead({{ $notification->id }})"
            onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.transform='translateX(4px)';"
            onmouseout="this.style.borderColor='rgba(56,189,248,{{ $notification->is_read ? '0.1' : '0.2' }}'; this.style.transform='translateX(0)';">
            
            @if(!$notification->is_read)
            <div style="position: absolute; top: 16px; right: 16px; width: 8px; height: 8px; background: #38bdf8; border-radius: 50%; box-shadow: 0 0 10px rgba(56,189,248,0.5);"></div>
            @endif

            <div style="display: flex; gap: 12px; align-items: start;">
                <div style="
                    width: 40px;
                    height: 40px;
                    background: linear-gradient(135deg, 
                        @if($notification->icon_type === 'success') #22c55e, #16a34a
                        @elseif($notification->icon_type === 'warning') #fbbf24, #f59e0b
                        @elseif($notification->icon_type === 'error') #ef4444, #dc2626
                        @else #38bdf8, #0ea5e9
                        @endif
                    );
                    border-radius: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 20px;
                    flex-shrink: 0;
                ">
                    @if($notification->icon_type === 'success') ✓
                    @elseif($notification->icon_type === 'warning') ⚠
                    @elseif($notification->icon_type === 'error') ✗
                    @else 🔔
                    @endif
                </div>

                <div style="flex: 1; min-width: 0;">
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0; word-wrap: break-word;">
                        {{ $notification->title }}
                    </h4>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0 0 6px 0; line-height: 1.5; word-wrap: break-word;">
                        {{ $notification->message }}
                    </p>
                    <span style="color: #64748b; font-size: 11px;">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div style="text-align: center; padding: 60px 20px; color: #94a3b8;">
            <div style="font-size: 48px; margin-bottom: 16px;">🔔</div>
            <div style="font-size: 16px; font-weight: 600; margin-bottom: 8px;">No Notifications</div>
            <div style="font-size: 14px;">You're all caught up!</div>
        </div>
        @endforelse

    </div>
</div>

<style>
    @media (max-width: 768px) {
        .header { padding: 10px 12px !important; }
        .pt-80 { padding-top: 70px !important; }
        .pb-80 { padding-bottom: 70px !important; }
        .tf-container { padding: 0 16px !important; }
        .notification-item { padding: 14px !important; }
    }
    
    @media (max-width: 480px) {
        .header { padding: 8px 12px !important; }
        .pt-80 { padding-top: 65px !important; }
        .notification-item { padding: 12px !important; margin-bottom: 10px !important; }
    }
</style>

<script>
async function markAsRead(id) {
    try {
        await fetch(`/api/notifications/${id}/read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        
        const item = document.querySelector(`[data-id="${id}"]`);
        if (item) {
            item.style.background = 'linear-gradient(135deg, rgba(56,189,248,0.03) 0%, rgba(56,189,248,0.02) 100%)';
            item.style.borderColor = 'rgba(56,189,248,0.1)';
            const dot = item.querySelector('div[style*="width: 8px"]');
            if (dot) dot.remove();
        }
    } catch (error) {
        console.error('Error marking notification as read:', error);
    }
}

async function markAllRead() {
    try {
        await fetch('/api/notifications/mark-all-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
        
        location.reload();
    } catch (error) {
        console.error('Error marking all as read:', error);
    }
}
</script>

@endsection
