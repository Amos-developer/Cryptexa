@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Language Settings | Cryptexa')

@section('content')

<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background: linear-gradient(135deg, #020617, #0f172a); border-bottom: 1px solid rgba(56,189,248,0.2); backdrop-filter: blur(10px); z-index: 100; padding: 12px 16px;">
    <a href="{{ route('account.settings') }}"
        style="width: 36px; height: 36px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Language</h6>
    <span style="width: 36px;"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh; padding-bottom: 100px;">
    <div class="tf-container">
        <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Choose Language</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">Select your preferred language</p>
        </div>

        @php
        $languages = [
            ['name' => 'English', 'code' => 'en', 'flag' => '🇬🇧', 'active' => true],
            ['name' => 'Español', 'code' => 'es', 'flag' => '🇪🇸', 'active' => false],
            ['name' => 'Français', 'code' => 'fr', 'flag' => '🇫🇷', 'active' => false],
            ['name' => 'Deutsch', 'code' => 'de', 'flag' => '🇩🇪', 'active' => false],
            ['name' => '中文', 'code' => 'zh', 'flag' => '🇨🇳', 'active' => false],
            ['name' => '日本語', 'code' => 'ja', 'flag' => '🇯🇵', 'active' => false],
            ['name' => '한국어', 'code' => 'ko', 'flag' => '🇰🇷', 'active' => false],
            ['name' => 'Português', 'code' => 'pt', 'flag' => '🇵🇹', 'active' => false],
            ['name' => 'Русский', 'code' => 'ru', 'flag' => '🇷🇺', 'active' => false],
            ['name' => 'العربية', 'code' => 'ar', 'flag' => '🇸🇦', 'active' => false],
            ['name' => 'हिन्दी', 'code' => 'hi', 'flag' => '🇮🇳', 'active' => false],
            ['name' => 'Italiano', 'code' => 'it', 'flag' => '🇮🇹', 'active' => false],
            ['name' => 'Nederlands', 'code' => 'nl', 'flag' => '🇳🇱', 'active' => false],
            ['name' => 'Türkçe', 'code' => 'tr', 'flag' => '🇹🇷', 'active' => false],
            ['name' => 'Polski', 'code' => 'pl', 'flag' => '🇵🇱', 'active' => false],
            ['name' => 'Tiếng Việt', 'code' => 'vi', 'flag' => '🇻🇳', 'active' => false],
            ['name' => 'ไทย', 'code' => 'th', 'flag' => '🇹🇭', 'active' => false],
            ['name' => 'Bahasa Indonesia', 'code' => 'id', 'flag' => '🇮🇩', 'active' => false],
            ['name' => 'Bahasa Melayu', 'code' => 'ms', 'flag' => '🇲🇾', 'active' => false],
            ['name' => 'Svenska', 'code' => 'sv', 'flag' => '🇸🇪', 'active' => false],
        ];
        @endphp

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; animation: slideUp 0.6s ease 0.1s backwards;">
            @foreach($languages as $index => $lang)
            <button onclick="selectLanguage('{{ $lang['code'] }}')" style="
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 12px;
                background: {{ $lang['active'] ? 'linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.05))' : 'linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05))' }};
                border: 1px solid {{ $lang['active'] ? 'rgba(56,189,248,0.3)' : 'rgba(56,189,248,0.2)' }};
                border-radius: 8px;
                cursor: pointer;
                transition: all 0.3s ease;
                animation: slideIn 0.5s ease {{ 0.05 * $index }}s backwards;
                position: relative;
            "
                onmouseover="this.style.borderColor='rgba(56,189,248,0.4)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 24px rgba(56,189,248,0.15)';"
                onmouseout="this.style.borderColor='{{ $lang['active'] ? 'rgba(56,189,248,0.3)' : 'rgba(56,189,248,0.2)' }}'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                <span style="font-size: 20px;">{{ $lang['flag'] }}</span>
                <div style="text-align: left; flex: 1;">
                    <div style="color: #e5e7eb; font-weight: 600; font-size: 13px;">{{ $lang['name'] }}</div>
                </div>
                @if($lang['active'])
                <div style="width: 18px; height: 18px; background: #22c55e; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                        <path d="M20 6L9 17l-5-5"/>
                    </svg>
                </div>
                @endif
            </button>
            @endforeach
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
        [style*="grid-template-columns: repeat(2, 1fr)"] { grid-template-columns: 1fr !important; }
    }
</style>

<script>
function selectLanguage(code) {
    // Show loading state
    const btn = event.currentTarget;
    btn.style.opacity = '0.6';
    btn.style.pointerEvents = 'none';
    
    // Simulate language change (implement actual logic here)
    setTimeout(() => {
        alert('Language changed to: ' + code.toUpperCase());
        btn.style.opacity = '1';
        btn.style.pointerEvents = 'auto';
    }, 500);
}
</script>

@endsection
