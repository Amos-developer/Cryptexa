@extends('layouts.app')

@section('title', 'Notifications | Cryptexa')

@section('hide-header', true)

@section('content')

<!-- HEADER BAR -->
<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        z-index: 100;
        padding: 12px 16px;
    ">
    <a href="{{ url()->previous() }}"
        style="
            width: 36px;
            height: 36px;
            background: rgba(56,189,248,0.1);
            border: 1px solid rgba(56,189,248,0.2);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        "
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Notifications</h6>
    <button onclick="markAllRead()" style="background: none; border: none; color: #38bdf8; font-size: 12px; cursor: pointer; font-weight: 600;">
        Mark all read
    </button>
</div>

<!-- MAIN CONTENT -->
<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">

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

                <div style="flex: 1;">
                    <h4 style="color: #e5e7eb; font-weight: 700; font-size: 14px; margin: 0 0 4px 0;">
                        {{ $notification->title }}
                    </h4>
                    <p style="color: #94a3b8; font-size: 13px; margin: 0 0 6px 0; line-height: 1.5;">
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
