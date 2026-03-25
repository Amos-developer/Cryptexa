@php
    $rawTitle = trim($__env->yieldContent('title', 'Cryptexa'));
    $heading = trim($__env->yieldContent('page-heading'));
    $backUrl = trim($__env->yieldContent('page-back-url', url()->previous()));

    if ($heading === '') {
        $heading = trim(explode('|', $rawTitle)[0]);
    }
@endphp

<div class="subpage-topbar-wrap">
    <div class="subpage-topbar">
        <a href="{{ $backUrl ?: url()->previous() }}" class="subpage-back" aria-label="Go back">
            <span aria-hidden="true">&#8249;</span>
        </a>
        <h1>{{ $heading }}</h1>
        <span class="placeholder"></span>
    </div>
</div>

<style>
    .subpage-topbar-wrap {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        z-index: 60;
        width: min(980px, calc(100% - 28px));
        pointer-events: none;
    }

    .subpage-topbar {
        pointer-events: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 12px;
        border: 1px solid rgba(106, 227, 255, 0.14);
        border-radius: 0 0 20px 20px;
        background: rgba(6, 16, 29, 0.82);
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.24);
    }

    .subpage-back {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(180deg, rgba(10, 24, 42, 0.96), rgba(7, 18, 34, 0.92));
        border: 1px solid rgba(106, 227, 255, 0.18);
        color: #6ae3ff;
        box-shadow: 0 16px 34px rgba(0, 0, 0, 0.25);
        text-decoration: none;
    }

    .subpage-back span {
        font-size: 1.75rem;
        line-height: 0.8;
        transform: translateX(-1px);
    }

    .subpage-topbar h1 {
        margin: 0;
        color: #e8f0ff;
        font-size: 1.05rem;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .subpage-topbar .placeholder {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
    }

    @media (min-width: 768px) {
        .subpage-topbar-wrap {
            width: min(980px, calc(100% - 36px));
        }
    }
</style>
