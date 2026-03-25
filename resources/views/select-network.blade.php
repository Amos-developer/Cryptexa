@extends('layouts.app')

@section('hide-header', true)
@section('title', 'Choose Network | Cryptexa')
@section('page-heading', __t('select_network'))

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}?v={{ filemtime(public_path('css/team.css')) }}">

<div class="select-network-page">
    <div style="display:none;">
    <a href="{{ url()->previous() }}" class="team-back">
        <span aria-hidden="true">‹</span>
    </a>
    <h1>{{ __t('select_network') }}</h1>
    <span class="placeholder"></span>
    </div>
    <div class="select-network-shell">
        <section class="select-hero">
            <div class="select-hero__glow select-hero__glow--cyan"></div>
            <div class="select-hero__glow select-hero__glow--green"></div>

            <div class="select-hero__content">
                <span class="select-hero__eyebrow">Funding Gateway</span>
                <h1 class="select-hero__title">{{ __t('select_network') }}</h1>
                <p class="select-hero__subtitle">{{ __t('choose_network') }}</p>
            </div>

            <div class="select-hero__status">
                <div class="select-status-chip select-status-chip--success">
                    <span class="select-status-chip__dot"></span>
                    <span>{{ __t('auto_credited') }}</span>
                </div>
                <div class="select-status-chip">
                    <span>{{ __t('min_deposit') }}</span>
                    <strong>$50</strong>
                </div>
            </div>
        </section>

        <form method="POST" action="{{ route('deposit.store') }}" id="deposit-form" class="select-form">
            @csrf
            @php
            $coins = [
            ['name'=>'USDT','symbol'=>'BEP20','network'=>'Binance Smart Chain','currency'=>'usdtbsc','badge'=>__t('recommended'),'color'=>'#26A17B','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="24" fill="#26A17B"/><path d="M25.8 14.4h-3.6v4.08c-4.98.24-8.7 1.2-8.7 2.34s3.72 2.1 8.7 2.34v1.44c-4.98.24-8.7 1.2-8.7 2.34 0 1.14 3.72 2.1 8.7 2.34v4.14h3.6v-4.14c4.95-.24 8.64-1.2 8.64-2.34 0-1.14-3.69-2.1-8.64-2.34v-1.44c4.95-.24 8.64-1.2 8.64-2.34s-3.69-2.1-8.64-2.34V14.4Zm0 12.36v-.06c3.3.18 5.46.6 5.46 1.08s-2.16.9-5.46 1.08v-2.1Zm-3.6 2.1c-3.33-.18-5.52-.6-5.52-1.08s2.19-.9 5.52-1.08v2.16Zm0-6.36c-3.33-.18-5.52-.6-5.52-1.08s2.19-.9 5.52-1.08v2.16Zm3.6-2.16c3.3.18 5.46.6 5.46 1.08s-2.16.9-5.46 1.08v-2.16Z" fill="#fff"/></svg>','fee'=>'~$0.20','time'=>'1-3 min'],
            ['name'=>'USDC','symbol'=>'BEP20','network'=>'Binance Smart Chain','currency'=>'usdcbsc','badge'=>__t('fast'),'color'=>'#2775CA','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="24" fill="#2775CA"/><circle cx="24" cy="24" r="10.5" stroke="#fff" stroke-width="2.2"/><path d="M25.73 17.7c1.46.3 2.57 1.28 3.07 2.64l-2.27.95c-.31-.8-.98-1.25-2.03-1.25-1.13 0-1.85.5-1.85 1.23 0 .68.5 1.03 1.91 1.35 2.74.61 4.29 1.63 4.29 3.93 0 1.92-1.27 3.31-3.43 3.76v1.71h-1.93v-1.63c-1.98-.22-3.4-1.31-4.05-3.14l2.34-.87c.39 1.01 1.26 1.55 2.54 1.55 1.2 0 1.97-.48 1.97-1.29 0-.73-.55-1.08-2.13-1.45-2.54-.58-4.02-1.55-4.02-3.78 0-1.86 1.26-3.19 3.35-3.64v-1.62h1.93v1.55Z" fill="#fff"/><path d="M15.5 18.6a12 12 0 0 0 0 10.8" stroke="#fff" stroke-width="2" stroke-linecap="round"/><path d="M32.5 18.6a12 12 0 0 1 0 10.8" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>','fee'=>'~$0.20','time'=>'1-3 min'],
            ['name'=>'USDT','symbol'=>'TRC20','network'=>'Tron Network','currency'=>'usdttrc20','badge'=>__t('secure'),'color'=>'#EB0029','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48" fill="none"><circle cx="24" cy="24" r="24" fill="#EB0029"/><path d="M14 14.5 20.77 31h11.5L34 19.04 14 14.5Zm4.3 3.08 10.8 2.18-6.2 6.08-4.6-8.26Zm5.9 10.42 6.66-6.41-1.24 7.52h-5.42Z" fill="#fff"/><path d="M20.76 31 22.9 25.84l6.36-6.08" stroke="#fff" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>','fee'=>'~$1.00','time'=>'2-5 min'],
            ['name'=>'BNB','symbol'=>'BSC','network'=>'Binance Coin','currency'=>'bnbbsc','badge'=>__t('native'),'color'=>'#F3BA2F','svg'=>'<svg width="48" height="48" viewBox="0 0 48 48"><circle cx="24" cy="24" r="24" fill="#F3BA2F"/><path d="M24 14.4l-3 3L24 20.4l3-3-3-3zm-6 6l-3 3 3 3 3-3-3-3zm12 0l-3 3 3 3 3-3-3-3zm-6 6l-3 3 3 3 3-3-3-3z" fill="white"/></svg>','fee'=>'~$0.15','time'=>'1-2 min'],
            ];
            @endphp

            <section class="select-panel">
                <div class="select-panel__head">
                    <div>
                        <span class="select-panel__kicker">Network Options</span>
                        <h2 class="select-panel__title">{{ __t('choose_network') }}</h2>
                    </div>
                    <div class="select-panel__pill">4 Assets</div>
                </div>

                <div class="network-grid">
                    @foreach ($coins as $index => $coin)
                    <button
                        type="submit"
                        name="currency"
                        value="{{ $coin['currency'] }}"
                        class="network-card"
                        style="--coin-color: {{ $coin['color'] }}; --stagger: {{ number_format(0.08 * $index, 2, '.', '') }}s;">
                        <span class="network-card__glow"></span>

                        <span class="network-card__icon">
                            {!! $coin['svg'] !!}
                        </span>

                        <span class="network-card__content">
                            <span class="network-card__row">
                                <span class="network-card__name">{{ $coin['name'] }}</span>
                                <span class="network-card__badge">{{ $coin['badge'] }}</span>
                            </span>
                            <span class="network-card__network">{{ $coin['symbol'] }} • {{ $coin['network'] }}</span>
                            <span class="network-card__meta">
                                <span class="network-card__meta-item">Settlement {{ $coin['time'] }}</span>
                                <span class="network-card__meta-item">Fee {{ $coin['fee'] }}</span>
                            </span>
                        </span>

                        <span class="network-card__arrow">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </span>
                    </button>
                    @endforeach
                </div>
            </section>
        </form>

        <section class="select-insights">
            <div class="insight-card insight-card--cyan">
                <div class="insight-card__icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    </svg>
                </div>
                <div>
                    <div class="insight-card__title">{{ __t('bank_grade_security') }}</div>
                    <div class="insight-card__text">{{ __t('all_transactions_encrypted') }}</div>
                </div>
            </div>

            <div class="insight-card insight-card--green">
                <div class="insight-card__icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <div>
                    <div class="insight-card__title">{{ __t('instant_processing') }}</div>
                    <div class="insight-card__text">{{ __t('deposits_auto_credited') }}</div>
                </div>
            </div>
        </section>

        <section class="trust-band">
            <div class="trust-band__title">{{ __t('trusted_by_users') }}</div>
            <div class="trust-band__text">{{ __t('audited_secured') }}</div>
        </section>
    </div>
</div>

<style>
.select-network-page {
    min-height: 100vh;
    padding: 62px 6px calc(env(safe-area-inset-bottom, 0px) + 14px);
    background:
        radial-gradient(circle at top center, rgba(56, 189, 248, 0.1), transparent 24%),
        radial-gradient(circle at 100% 0%, rgba(34, 197, 94, 0.08), transparent 20%),
        linear-gradient(180deg, #020617 0%, #0b1220 55%, #0f172a 100%);
}

.select-network-shell {
    max-width: 560px;
    margin: 0 auto;
}

.select-hero,
.select-panel,
.insight-card,
.trust-band {
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    border: 1px solid rgba(106, 227, 255, 0.14);
    background:
        linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.01)),
        linear-gradient(180deg, rgba(11, 20, 37, 0.98), rgba(9, 18, 33, 0.94));
    box-shadow:
        0 20px 44px rgba(0, 0, 0, 0.24),
        inset 0 1px 0 rgba(255, 255, 255, 0.04);
}

.select-hero {
    padding: 13px 10px;
    margin-bottom: 8px;
}

.select-hero__glow {
    position: absolute;
    border-radius: 999px;
    filter: blur(12px);
    pointer-events: none;
}

.select-hero__glow--cyan {
    top: -42px;
    right: -18px;
    width: 160px;
    height: 160px;
    background: radial-gradient(circle, rgba(56, 189, 248, 0.2), transparent 70%);
}

.select-hero__glow--green {
    left: -36px;
    bottom: -64px;
    width: 150px;
    height: 150px;
    background: radial-gradient(circle, rgba(34, 197, 94, 0.14), transparent 70%);
}

.select-hero__content,
.select-hero__status {
    position: relative;
    z-index: 1;
}

.select-hero__eyebrow {
    display: inline-flex;
    margin-bottom: 6px;
    padding: 5px 8px;
    border-radius: 999px;
    border: 1px solid rgba(56, 189, 248, 0.18);
    background: rgba(56, 189, 248, 0.08);
    color: #b7f4ff;
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}

.select-hero__title {
    margin: 0 0 6px;
    color: #f8fbff;
    font-size: 24px;
    font-weight: 900;
    letter-spacing: -0.05em;
    line-height: 1.05;
}

.select-hero__subtitle {
    margin: 0;
    color: rgba(226, 232, 240, 0.72);
    font-size: 12px;
    line-height: 1.45;
}

.select-hero__status {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 10px;
}

.select-status-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    min-height: 30px;
    padding: 0 9px;
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.08);
    background: rgba(255, 255, 255, 0.04);
    color: #dce7f5;
    font-size: 11px;
    font-weight: 700;
}

.select-status-chip strong {
    color: #f8fbff;
    font-size: 12px;
}

.select-status-chip--success {
    border-color: rgba(34, 197, 94, 0.16);
    background: rgba(34, 197, 94, 0.08);
    color: #86efac;
}

.select-status-chip__dot {
    width: 7px;
    height: 7px;
    border-radius: 999px;
    background: #22c55e;
    box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.16);
}

.select-panel {
    padding: 10px;
}

.select-panel__head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 8px;
}

.select-panel__kicker {
    display: inline-block;
    margin-bottom: 4px;
    color: rgba(106, 227, 255, 0.72);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.14em;
    text-transform: uppercase;
}

.select-panel__title {
    margin: 0;
    color: #f8fbff;
    font-size: 16px;
    font-weight: 800;
    letter-spacing: -0.03em;
}

.select-panel__pill {
    flex-shrink: 0;
    padding: 6px 8px;
    border-radius: 999px;
    background: rgba(56, 189, 248, 0.1);
    border: 1px solid rgba(56, 189, 248, 0.18);
    color: #7dd3fc;
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.network-grid {
    display: grid;
    gap: 6px;
}

.network-card {
    position: relative;
    width: 100%;
    padding: 10px;
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 8px;
    align-items: center;
    border-radius: 15px;
    border: 1px solid rgba(56, 189, 248, 0.16);
    background: linear-gradient(135deg, rgba(56, 189, 248, 0.08), rgba(56, 189, 248, 0.02));
    cursor: pointer;
    text-align: left;
    overflow: hidden;
    transition: transform 0.24s ease, border-color 0.24s ease, box-shadow 0.24s ease;
    animation: networkCardIn 0.55s ease var(--stagger) backwards;
}

.network-card:hover,
.network-card:focus-visible {
    transform: translateY(-3px);
    border-color: rgba(56, 189, 248, 0.34);
    box-shadow: 0 18px 34px rgba(56, 189, 248, 0.16);
    outline: none;
}

.network-card__glow {
    position: absolute;
    top: -20px;
    right: -10px;
    width: 120px;
    height: 120px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.14) 0%, transparent 70%);
    pointer-events: none;
}

.network-card__icon,
.network-card__content,
.network-card__arrow {
    position: relative;
    z-index: 1;
}

.network-card__icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.network-card__icon svg {
    display: block;
    width: 44px;
    height: 44px;
}

.network-card__row {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 6px;
    margin-bottom: 3px;
}

.network-card__name {
    color: #f8fbff;
    font-size: 14px;
    font-weight: 800;
}

.network-card__badge {
    padding: 3px 7px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.08);
    color: var(--coin-color);
    font-size: 9px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
}

.network-card__network {
    display: block;
    color: rgba(226, 232, 240, 0.72);
    font-size: 11px;
    margin-bottom: 4px;
}

.network-card__meta {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.network-card__meta-item {
    display: inline-flex;
    min-height: 20px;
    align-items: center;
    padding: 0 6px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.04);
    color: #94a3b8;
    font-size: 9px;
    font-weight: 700;
}

.network-card__arrow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    border-radius: 10px;
    background: rgba(56, 189, 248, 0.1);
    color: #38bdf8;
}

.select-insights {
    display: grid;
    gap: 6px;
    margin-top: 8px;
}

.insight-card {
    padding: 9px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.insight-card--cyan {
    border-color: rgba(56, 189, 248, 0.14);
    background:
        linear-gradient(180deg, rgba(56, 189, 248, 0.08), rgba(56, 189, 248, 0.03)),
        linear-gradient(180deg, rgba(11, 20, 37, 0.98), rgba(9, 18, 33, 0.94));
}

.insight-card--green {
    border-color: rgba(34, 197, 94, 0.14);
    background:
        linear-gradient(180deg, rgba(34, 197, 94, 0.08), rgba(34, 197, 94, 0.03)),
        linear-gradient(180deg, rgba(11, 20, 37, 0.98), rgba(9, 18, 33, 0.94));
}

.insight-card__icon {
    width: 30px;
    height: 30px;
    border-radius: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background: linear-gradient(135deg, #38bdf8, #0ea5e9);
    box-shadow: 0 12px 24px rgba(56, 189, 248, 0.22);
}

.insight-card--green .insight-card__icon {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    box-shadow: 0 12px 24px rgba(34, 197, 94, 0.2);
}

.insight-card__title {
    color: #f8fbff;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 3px;
}

.insight-card__text {
    color: #94a3b8;
    font-size: 10px;
    line-height: 1.35;
}

.trust-band {
    margin-top: 8px;
    padding: 10px;
    text-align: center;
    border-color: rgba(168, 85, 247, 0.16);
    background:
        linear-gradient(180deg, rgba(168, 85, 247, 0.08), rgba(168, 85, 247, 0.03)),
        linear-gradient(180deg, rgba(11, 20, 37, 0.98), rgba(9, 18, 33, 0.94));
}

.trust-band__title {
    color: #c084fc;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 4px;
}

.trust-band__text {
    color: #94a3b8;
    font-size: 10px;
    line-height: 1.35;
}

@keyframes networkCardIn {
    from {
        opacity: 0;
        transform: translateY(18px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 640px) {
    .select-network-page {
        padding: 60px 6px calc(env(safe-area-inset-bottom, 0px) + 12px);
    }

    .select-hero {
        padding: 12px 9px;
    }

    .select-hero__title {
        font-size: 21px;
    }

    .select-panel {
        padding: 9px;
    }

    .select-panel__head {
        flex-direction: column;
        align-items: flex-start;
    }

    .network-card {
        grid-template-columns: auto 1fr;
        padding: 9px;
    }

    .network-card__arrow {
        grid-column: 2;
        justify-self: end;
    }

    .network-card__icon svg {
        width: 40px;
        height: 40px;
    }
}

@media (min-width: 768px) {
    .select-network-page {
        padding: 76px 10px 18px;
    }

    .select-network-shell {
        max-width: 680px;
    }

    .select-hero {
        padding: 14px 11px;
    }

    .select-panel {
        padding: 11px;
    }
}
</style>

@endsection

@section('scripts')
<script>
document.getElementById('deposit-form').addEventListener('submit', function(e) {
    e.target.querySelectorAll('button[type="submit"]').forEach(button => {
        button.disabled = true;
    });
});
</script>
@endsection
