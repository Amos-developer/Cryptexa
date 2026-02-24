@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Notifications | Cryptexa')

@section('content')

<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background: linear-gradient(135deg, #020617, #0f172a); border-bottom: 1px solid rgba(56,189,248,0.2); backdrop-filter: blur(10px); z-index: 100; padding: 12px 16px;">
    <a href="{{ route('account.settings') }}"
        style="width: 36px; height: 36px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">Notifications</h6>
    <span style="width: 36px;"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">
        <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">Notification Settings</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">Manage how you receive notifications</p>
        </div>

        @php
        $notificationGroups = [
            [
                'title' => 'Transaction Alerts',
                'items' => [
                    ['label' => 'Deposit Confirmations', 'desc' => 'Get notified when deposits are confirmed', 'enabled' => true],
                    ['label' => 'Withdrawal Updates', 'desc' => 'Receive updates on withdrawal status', 'enabled' => true],
                    ['label' => 'Payment Received', 'desc' => 'Alert when payments are received', 'enabled' => true],
                ]
            ],
            [
                'title' => 'Security Alerts',
                'items' => [
                    ['label' => 'Login Notifications', 'desc' => 'Alert on new device login', 'enabled' => true],
                    ['label' => 'Password Changes', 'desc' => 'Notify when password is changed', 'enabled' => true],
                    ['label' => 'Suspicious Activity', 'desc' => 'Alert on unusual account activity', 'enabled' => true],
                ]
            ],
            [
                'title' => 'Marketing',
                'items' => [
                    ['label' => 'Promotions', 'desc' => 'Receive promotional offers', 'enabled' => false],
                    ['label' => 'Newsletter', 'desc' => 'Weekly newsletter updates', 'enabled' => false],
                ]
            ],
        ];
        @endphp

        @foreach($notificationGroups as $groupIndex => $group)
        <div style="margin-bottom: 24px; animation: slideUp 0.6s ease {{ 0.1 * $groupIndex }}s backwards;">
            <h3 style="color: #38bdf8; font-weight: 700; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin: 0 0 12px 0;">{{ $group['title'] }}</h3>
            <div style="display: grid; gap: 12px;">
                @foreach($group['items'] as $item)
                <div style="
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    padding: 16px;
                    background: linear-gradient(180deg, rgba(255,255,255,0.01), rgba(255,255,255,0.02));
                    border: 1px solid rgba(255,255,255,0.06);
                    border-radius: 12px;
                    gap: 12px;
                ">
                    <div style="flex: 1; min-width: 0;">
                        <div style="color: #e5e7eb; font-weight: 700; font-size: 15px; margin-bottom: 4px;">{{ $item['label'] }}</div>
                        <div style="color: #64748b; font-size: 13px; line-height: 1.4;">{{ $item['desc'] }}</div>
                    </div>
                    <label class="toggle-switch" style="position: relative; display: inline-block; width: 48px; height: 26px; cursor: pointer; flex-shrink: 0;">
                        <input type="checkbox" {{ $item['enabled'] ? 'checked' : '' }} onchange="toggleNotification(this, '{{ strtolower(str_replace(' ', '_', $item['label'])) }}')"
                            style="opacity: 0; width: 0; height: 0;">
                        <span class="slider" style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background: {{ $item['enabled'] ? '#22c55e' : '#334155' }};
                            border-radius: 26px;
                            transition: 0.3s;
                        ">
                            <span class="slider-button" style="
                                position: absolute;
                                content: '';
                                height: 20px;
                                width: 20px;
                                left: {{ $item['enabled'] ? '25px' : '3px' }};
                                bottom: 3px;
                                background: white;
                                border-radius: 50%;
                                transition: 0.3s;
                            "></span>
                        </span>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    
    @media (max-width: 768px) {
        .header { padding: 10px 12px !important; }
        .pt-80 { padding-top: 70px !important; }
        .pb-80 { padding-bottom: 70px !important; }
        .tf-container { padding: 0 16px !important; }
        h1 { font-size: 22px !important; }
        h3 { font-size: 13px !important; }
    }
    
    @media (max-width: 480px) {
        .header { padding: 8px 12px !important; }
        .pt-80 { padding-top: 65px !important; }
        h1 { font-size: 20px !important; }
    }
</style>

<script>
function toggleNotification(checkbox, type) {
    const label = checkbox.closest('.toggle-switch');
    const slider = label.querySelector('.slider');
    const button = label.querySelector('.slider-button');
    
    if (checkbox.checked) {
        slider.style.background = '#22c55e';
        button.style.left = '25px';
    } else {
        slider.style.background = '#334155';
        button.style.left = '3px';
    }
    
    // Save preference (you can add API call here)
    console.log(`Notification ${type}: ${checkbox.checked ? 'enabled' : 'disabled'}`);
    
    // Show feedback
    const feedback = document.createElement('div');
    feedback.textContent = checkbox.checked ? '✓ Enabled' : '✗ Disabled';
    feedback.style.cssText = `
        position: fixed;
        top: 80px;
        right: 20px;
        background: ${checkbox.checked ? '#22c55e' : '#ef4444'};
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        z-index: 1000;
        animation: slideIn 0.3s ease;
    `;
    document.body.appendChild(feedback);
    setTimeout(() => feedback.remove(), 2000);
}
</script>

@endsection
