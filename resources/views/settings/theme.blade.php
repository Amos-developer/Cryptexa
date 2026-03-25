@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Theme Settings | Cryptexa')
@section('page-heading', 'Theme')
@section('page-back-url', route('account.settings'))

@section('content')

<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background: linear-gradient(135deg, #020617, #0f172a); border-bottom: 1px solid rgba(56,189,248,0.2); backdrop-filter: blur(10px); z-index: 100; padding: 12px 16px;">
    <a href="{{ route('account.settings') }}"
        style="width: 36px; height: 36px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Theme</h6>
    <span style="width: 36px;"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh; padding-bottom: 100px;">
    <div class="tf-container">
        <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Choose Theme</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">Select your preferred theme</p>
        </div>

        @php
        $themes = [
            ['name' => 'Dark Mode', 'code' => 'dark', 'icon' => '🌙', 'desc' => 'Easy on the eyes', 'active' => true],
            ['name' => 'Light Mode', 'code' => 'light', 'icon' => '☀️', 'desc' => 'Bright and clear', 'active' => false],
            ['name' => 'Auto', 'code' => 'auto', 'icon' => '🔄', 'desc' => 'Follow system settings', 'active' => false],
        ];
        @endphp

        <div style="display: grid; gap: 12px; animation: slideUp 0.6s ease 0.1s backwards;">
            @foreach($themes as $index => $theme)
            <button onclick="selectTheme('{{ $theme['code'] }}')" style="
                display: flex;
                align-items: center;
                gap: 16px;
                padding: 20px;
                background: {{ $theme['active'] ? 'linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.05))' : 'linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02))' }};
                border: 1px solid {{ $theme['active'] ? 'rgba(56,189,248,0.3)' : 'rgba(255,255,255,0.06)' }};
                border-radius: 16px;
                cursor: pointer;
                transition: all 0.3s ease;
                animation: slideIn 0.5s ease {{ 0.1 * $index }}s backwards;
                position: relative;
            "
                onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(56,189,248,0.15)';"
                onmouseout="this.style.borderColor='{{ $theme['active'] ? 'rgba(56,189,248,0.3)' : 'rgba(255,255,255,0.06)' }}'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                
                <div style="width: 60px; height: 60px; background: rgba(56,189,248,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 32px;">
                    {{ $theme['icon'] }}
                </div>
                
                <div style="text-align: left; flex: 1;">
                    <div style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin-bottom: 4px;">{{ $theme['name'] }}</div>
                    <div style="color: #64748b; font-size: 13px;">{{ $theme['desc'] }}</div>
                </div>
                
                @if($theme['active'])
                <div style="position: absolute; top: 12px; right: 12px; width: 24px; height: 24px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                </div>
                @endif
            </button>
            @endforeach
        </div>

        <div style="
            background: linear-gradient(135deg, rgba(168,85,247,0.05) 0%, rgba(168,85,247,0.02) 100%);
            border: 1px solid rgba(168,85,247,0.15);
            border-radius: 16px;
            padding: 16px;
            margin-top: 24px;
            animation: slideUp 0.6s ease 0.4s backwards;
        ">
            <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.6;">
                <span style="color: #a855f7; font-weight: 600;">💡 Tip:</span> Auto mode will automatically switch between light and dark themes based on your device settings.
            </p>
        </div>
    </div>
</div>

<style>
    body { overflow-y: auto !important; height: auto !important; }
    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: translateX(-15px); } to { opacity: 1; transform: translateX(0); } }
    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        .pb-80 { padding-bottom: 120px !important; }
        h1[style*="font-size: 28px"] { font-size: 24px !important; }
    }
</style>

<script>
function selectTheme(code) {
    const btn = event.currentTarget;
    btn.style.opacity = '0.6';
    btn.style.pointerEvents = 'none';
    
    // Save theme to localStorage
    localStorage.setItem('theme', code);
    
    // Apply theme
    applyTheme(code);
    
    // Show success message
    setTimeout(() => {
        Swal.fire({
            title: 'Success!',
            text: 'Theme changed to: ' + code.toUpperCase(),
            icon: 'success',
            confirmButtonColor: '#22c55e',
            background: '#020617',
            color: '#e5e7eb',
            timer: 2000
        }).then(() => {
            window.location.href = '{{ route("account.settings") }}';
        });
    }, 300);
}

function applyTheme(theme) {
    const body = document.body;
    const appDiv = document.querySelector('.app-dark');
    
    if (theme === 'light') {
        body.classList.remove('app-dark');
        body.classList.add('app-light');
        if (appDiv) {
            appDiv.classList.remove('app-dark');
            appDiv.classList.add('app-light');
        }
    } else if (theme === 'dark') {
        body.classList.remove('app-light');
        body.classList.add('app-dark');
        if (appDiv) {
            appDiv.classList.remove('app-light');
            appDiv.classList.add('app-dark');
        }
    } else if (theme === 'auto') {
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        applyTheme(prefersDark ? 'dark' : 'light');
    }
}

// Load saved theme on page load
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'dark';
    applyTheme(savedTheme);
});
</script>

@endsection
