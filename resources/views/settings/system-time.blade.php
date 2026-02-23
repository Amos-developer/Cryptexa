@extends('layouts.app')

@section('hide-header', true)
@section('title', 'System Time | Cryptexa')

@section('content')

<div class="header fixed-top d-flex justify-content-between align-items-center px-16"
    style="background: linear-gradient(135deg, #020617, #0f172a); border-bottom: 1px solid rgba(56,189,248,0.2); backdrop-filter: blur(10px); z-index: 100; padding: 12px 16px;">
    <a href="{{ route('account.settings') }}"
        style="width: 36px; height: 36px; background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease;"
        onmouseover="this.style.background='rgba(56,189,248,0.15)'; this.style.borderColor='rgba(56,189,248,0.4)';"
        onmouseout="this.style.background='rgba(56,189,248,0.1)'; this.style.borderColor='rgba(56,189,248,0.2)';">
        <i class="icon-left-btn" style="color: #38bdf8; font-size: 18px;"></i>
    </a>
    <h6 style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin: 0;">System Time</h6>
    <span style="width: 36px;"></span>
</div>

<div class="pt-80 pb-80" style="background: linear-gradient(135deg, #020617 0%, #0f172a 100%); min-height: 100vh;">
    <div class="tf-container">
        <div style="margin-bottom: 24px; animation: slideDown 0.6s ease;">
            <h1 style="color: #e5e7eb; font-weight: 900; font-size: 28px; margin: 0 0 8px 0;">System Time</h1>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">View current server time and timezone information</p>
        </div>

        <!-- Server Time -->
        <div style="background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.3); border-radius: 16px; padding: 32px 24px; text-align: center; margin-bottom: 16px; animation: slideUp 0.6s ease 0.1s backwards;">
            <div style="color: #38bdf8; font-size: 14px; font-weight: 600; margin-bottom: 12px;">SERVER TIME (UTC)</div>
            <div id="liveClock" style="color: #e5e7eb; font-weight: 900; font-size: 48px; font-family: 'Courier New', monospace; margin-bottom: 8px;">{{ now()->format('H:i:s') }}</div>
            <div id="liveDate" style="color: #94a3b8; font-size: 16px; font-weight: 600;">{{ now()->format('l, F j, Y') }}</div>
        </div>

        <!-- Your Local Time -->
        <div style="background: linear-gradient(135deg, rgba(34,197,94,0.1), rgba(34,197,94,0.05)); border: 1px solid rgba(34,197,94,0.3); border-radius: 16px; padding: 32px 24px; text-align: center; margin-bottom: 24px; animation: slideUp 0.6s ease 0.15s backwards;">
            <div style="color: #22c55e; font-size: 14px; font-weight: 600; margin-bottom: 12px;">YOUR LOCAL TIME</div>
            <div id="localClock" style="color: #e5e7eb; font-weight: 900; font-size: 48px; font-family: 'Courier New', monospace; margin-bottom: 8px;">--:--:--</div>
            <div id="localDate" style="color: #94a3b8; font-size: 16px; font-weight: 600;">Loading...</div>
            <div id="localTimezone" style="color: #64748b; font-size: 13px; margin-top: 8px;"></div>
        </div>

        <!-- Timezone Info -->
        <div style="background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 20px; margin-bottom: 16px; animation: slideUp 0.6s ease 0.2s backwards;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <div style="color: #e5e7eb; font-weight: 700; font-size: 16px;">Timezone Information</div>
            </div>
            <div style="display: grid; gap: 12px;">
                <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(56,189,248,0.05); border-radius: 8px;">
                    <span style="color: #94a3b8; font-size: 14px;">Server Timezone</span>
                    <span style="color: #38bdf8; font-size: 14px; font-weight: 600;">{{ config('app.timezone') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(56,189,248,0.05); border-radius: 8px;">
                    <span style="color: #94a3b8; font-size: 14px;">UTC Offset</span>
                    <span style="color: #38bdf8; font-size: 14px; font-weight: 600;">{{ now()->format('P') }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(56,189,248,0.05); border-radius: 8px;">
                    <span style="color: #94a3b8; font-size: 14px;">Timezone Abbreviation</span>
                    <span style="color: #38bdf8; font-size: 14px; font-weight: 600;">{{ now()->format('T') }}</span>
                </div>
            </div>
        </div>

        <!-- World Clocks -->
        <div style="background: linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0.01)); border: 1px solid rgba(255,255,255,0.06); border-radius: 12px; padding: 20px; animation: slideUp 0.6s ease 0.3s backwards;">
            <div style="color: #e5e7eb; font-weight: 700; font-size: 16px; margin-bottom: 16px;">World Clocks</div>
            <div style="display: grid; gap: 12px;">
                @php
                $worldTimezones = [
                    ['name' => 'New York', 'tz' => 'America/New_York', 'flag' => '🇺🇸'],
                    ['name' => 'London', 'tz' => 'Europe/London', 'flag' => '🇬🇧'],
                    ['name' => 'Tokyo', 'tz' => 'Asia/Tokyo', 'flag' => '🇯🇵'],
                    ['name' => 'Dubai', 'tz' => 'Asia/Dubai', 'flag' => '🇦🇪'],
                    ['name' => 'Sydney', 'tz' => 'Australia/Sydney', 'flag' => '🇦🇺'],
                    ['name' => 'Hong Kong', 'tz' => 'Asia/Hong_Kong', 'flag' => '🇭🇰'],
                ];
                @endphp
                @foreach($worldTimezones as $tz)
                <div style="display: flex; justify-content: space-between; align-items: center; padding: 12px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); border-radius: 8px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="font-size: 24px;">{{ $tz['flag'] }}</span>
                        <div>
                            <div style="color: #e5e7eb; font-size: 14px; font-weight: 600;">{{ $tz['name'] }}</div>
                            <div style="color: #64748b; font-size: 12px;">{{ $tz['tz'] }}</div>
                        </div>
                    </div>
                    <div class="world-clock" data-timezone="{{ $tz['tz'] }}" style="color: #38bdf8; font-size: 14px; font-weight: 600; font-family: 'Courier New', monospace;">
                        {{ now()->timezone($tz['tz'])->format('H:i:s') }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div style="background: linear-gradient(135deg, rgba(56,189,248,0.05), rgba(56,189,248,0.02)); border: 1px solid rgba(56,189,248,0.15); border-radius: 12px; padding: 16px; margin-top: 24px; text-align: center; animation: slideUp 0.6s ease 0.4s backwards;">
            <p style="color: #94a3b8; font-size: 13px; margin: 0;">
                <span style="color: #38bdf8; font-weight: 600;">💡 Note:</span> All transactions and check-ins are based on server time ({{ config('app.timezone') }})
            </p>
        </div>
    </div>
</div>

<style>
    @keyframes slideDown { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @media (max-width: 768px) {
        .pt-80 { padding-top: 80px !important; }
        h1[style*="font-size: 28px"] { font-size: 24px !important; }
        #liveClock, #localClock { font-size: 36px !important; }
    }
</style>

<script>
    function updateClocks() {
        const now = new Date();
        
        // Update server clock (UTC)
        const utcHours = String(now.getUTCHours()).padStart(2, '0');
        const utcMinutes = String(now.getUTCMinutes()).padStart(2, '0');
        const utcSeconds = String(now.getUTCSeconds()).padStart(2, '0');
        document.getElementById('liveClock').textContent = `${utcHours}:${utcMinutes}:${utcSeconds}`;
        
        // Update local clock
        const localHours = String(now.getHours()).padStart(2, '0');
        const localMinutes = String(now.getMinutes()).padStart(2, '0');
        const localSeconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('localClock').textContent = `${localHours}:${localMinutes}:${localSeconds}`;
        
        // Update local date
        const localDate = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        document.getElementById('localDate').textContent = localDate;
        
        // Update local timezone
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        const offset = -now.getTimezoneOffset() / 60;
        const offsetStr = offset >= 0 ? `+${offset}` : offset;
        document.getElementById('localTimezone').textContent = `${timezone} (UTC${offsetStr})`;
        
        // Update world clocks
        document.querySelectorAll('.world-clock').forEach(clock => {
            const timezone = clock.dataset.timezone;
            const timeString = now.toLocaleTimeString('en-US', {
                timeZone: timezone,
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            clock.textContent = timeString;
        });
    }
    
    updateClocks();
    setInterval(updateClocks, 1000);
</script>

@endsection
