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

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">
        <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Choose Language</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">Select your preferred language</p>
        </div>

        @php
        $languages = [
            ['name' => 'English', 'code' => 'en', 'flag' => '🇺🇸', 'active' => true],
            ['name' => 'Español', 'code' => 'es', 'flag' => '🇪🇸', 'active' => false],
            ['name' => '中文', 'code' => 'zh', 'flag' => '🇨🇳', 'active' => false],
            ['name' => '日本語', 'code' => 'ja', 'flag' => '🇯🇵', 'active' => false],
            ['name' => 'Français', 'code' => 'fr', 'flag' => '🇫🇷', 'active' => false],
            ['name' => 'Deutsch', 'code' => 'de', 'flag' => '🇩🇪', 'active' => false],
        ];
        @endphp

        <div style="display: grid; gap: 12px; animation: slideUp 0.6s ease 0.1s backwards;">
            @foreach($languages as $index => $lang)
            <button style="
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 16px;
                background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));
                border: 1px solid {{ $lang['active'] ? 'rgba(56,189,248,0.3)' : 'rgba(255,255,255,0.06)' }};
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.3s ease;
                animation: slideIn 0.5s ease {{ 0.1 * $index }}s backwards;
            "
                onmouseover="this.style.borderColor='rgba(56,189,248,0.3)'; this.style.background='rgba(56,189,248,0.05)';"
                onmouseout="this.style.borderColor='{{ $lang['active'] ? 'rgba(56,189,248,0.3)' : 'rgba(255,255,255,0.06)' }}'; this.style.background='linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02))';">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <span style="font-size: 32px;">{{ $lang['flag'] }}</span>
                    <div style="text-align: left;">
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 15px;">{{ $lang['name'] }}</div>
                        <div style="color: #64748b; font-size: 12px;">{{ strtoupper($lang['code']) }}</div>
                    </div>
                </div>
                @if($lang['active'])
                <div style="background: rgba(56,189,248,0.2); color: #38bdf8; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Active</div>
                @endif
            </button>
            @endforeach
        </div>
    </div>
</div>

<style>
    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: translateX(-15px); } to { opacity: 1; transform: translateX(0); } }
    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        h1[style*="font-size: 28px"] { font-size: 24px !important; }
    }
</style>

@endsection
