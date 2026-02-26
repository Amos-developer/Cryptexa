@extends('layouts.app')

@section('title', 'Leadership Ranks Guide')
@section('hide-header', true)

@section('content')

<link rel="stylesheet" href="{{ asset('css/team.css') }}">

<style>
@keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
@keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
.section { animation: slideUp 0.5s ease; }
.rank-card { animation: slideUp 0.6s ease; }
</style>

<div style="min-height: 100vh; background: linear-gradient(135deg, #0f172a 0%, #1a1f3a 50%, #0d1726 100%); padding: 16px; padding-bottom: 80px;">
    <div style="max-width: 800px; margin: 0 auto;">
        
        <!-- HEADER BAR -->
        <div class="team-header">
            <a href="{{ url()->previous() }}" class="back-btn">
                <i class="icon-left-btn"></i>
            </a>
            <h6 class="header-title">Leadership Ranks Guide</h6>
            <span class="placeholder"></span>
        </div>

        <!-- Hero Section -->
        <div class="section" style="background: linear-gradient(135deg, rgba(56,189,248,0.2), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.3); border-radius: 20px; padding: 30px 20px; margin-top: 50px; margin-bottom: 20px; text-align: center; box-shadow: 0 8px 24px rgba(56,189,248,0.15);">
            <div style="font-size: 48px; margin-bottom: 12px;">🏆</div>
            <h2 style="color: #38bdf8; font-size: 28px; font-weight: 900; margin: 0 0 10px 0;">Cryptexa Leadership Ranks</h2>
            <p style="color: #94a3b8; font-size: 14px; margin: 0;">Build your team, earn rewards, and climb the ranks</p>
        </div>

        <!-- Overview -->
        <div class="section" style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(56,189,248,0.15); border-radius: 20px; padding: 24px; margin-bottom: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <path d="M12 16v-4M12 8h.01"/>
                </svg>
                <h3 style="color: #38bdf8; font-size: 20px; font-weight: 700; margin: 0;">How It Works</h3>
            </div>
            <p style="color: #94a3b8; font-size: 14px; line-height: 1.8; margin: 0 0 16px 0;">
                Ranks are based on <strong style="color: #22c55e;">active members</strong> in your 3-level referral network. An active member is anyone who has made at least one completed deposit.
            </p>
            <div style="background: rgba(251,191,36,0.1); border: 1px solid rgba(251,191,36,0.25); border-radius: 12px; padding: 16px;">
                <p style="color: #fbbf24; font-size: 13px; font-weight: 700; margin: 0 0 8px 0;">Active Member = Member with ≥1 Completed Deposit</p>
                <p style="color: #94a3b8; font-size: 12px; margin: 0;">Counts across Level 1 + Level 2 + Level 3</p>
            </div>
        </div>

        <!-- Rank Cards -->
        <div style="margin-bottom: 20px;">
            <h3 style="color: #e5e7eb; font-size: 18px; font-weight: 700; margin: 0 0 16px 0; padding: 0 4px;">🎯 Rank Requirements</h3>
            
            <!-- Junior Leader -->
            <div class="rank-card" style="background: linear-gradient(135deg, rgba(34,197,94,0.15), rgba(34,197,94,0.05)); border: 1px solid rgba(34,197,94,0.3); border-radius: 20px; padding: 24px; margin-bottom: 16px; box-shadow: 0 4px 16px rgba(34,197,94,0.1);">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                    <div style="font-size: 48px;">🌟</div>
                    <div style="flex: 1;">
                        <h4 style="color: #22c55e; font-size: 22px; font-weight: 800; margin: 0 0 4px 0;">Junior Leader</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Entry Level Rank</p>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Required</p>
                        <p style="color: #22c55e; font-size: 24px; font-weight: 800; margin: 0;">3 Active</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Bonus</p>
                        <p style="color: #22c55e; font-size: 24px; font-weight: 800; margin: 0;">$5</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Weekly</p>
                        <p style="color: #64748b; font-size: 20px; font-weight: 800; margin: 0;">None</p>
                    </div>
                </div>
            </div>

            <!-- Elite Leader -->
            <div class="rank-card" style="background: linear-gradient(135deg, rgba(56,189,248,0.15), rgba(56,189,248,0.05)); border: 1px solid rgba(56,189,248,0.3); border-radius: 20px; padding: 24px; margin-bottom: 16px; box-shadow: 0 4px 16px rgba(56,189,248,0.1); animation-delay: 0.1s;">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                    <div style="font-size: 48px;">💎</div>
                    <div style="flex: 1;">
                        <h4 style="color: #38bdf8; font-size: 22px; font-weight: 800; margin: 0 0 4px 0;">Elite Leader</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Professional Level</p>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Required</p>
                        <p style="color: #38bdf8; font-size: 24px; font-weight: 800; margin: 0;">10 Active</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Bonus</p>
                        <p style="color: #38bdf8; font-size: 24px; font-weight: 800; margin: 0;">$20</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Weekly</p>
                        <p style="color: #22c55e; font-size: 24px; font-weight: 800; margin: 0;">$10</p>
                    </div>
                </div>
            </div>

            <!-- Legendary Leader -->
            <div class="rank-card" style="background: linear-gradient(135deg, rgba(245,158,11,0.15), rgba(245,158,11,0.05)); border: 1px solid rgba(245,158,11,0.3); border-radius: 20px; padding: 24px; margin-bottom: 16px; box-shadow: 0 4px 16px rgba(245,158,11,0.1); animation-delay: 0.2s;">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                    <div style="font-size: 48px;">⭐</div>
                    <div style="flex: 1;">
                        <h4 style="color: #f59e0b; font-size: 22px; font-weight: 800; margin: 0 0 4px 0;">Legendary Leader</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Advanced Level</p>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Required</p>
                        <p style="color: #f59e0b; font-size: 24px; font-weight: 800; margin: 0;">30 Active</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Bonus</p>
                        <p style="color: #f59e0b; font-size: 24px; font-weight: 800; margin: 0;">$50</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Weekly</p>
                        <p style="color: #22c55e; font-size: 24px; font-weight: 800; margin: 0;">$25</p>
                    </div>
                </div>
            </div>

            <!-- Grand Leader -->
            <div class="rank-card" style="background: linear-gradient(135deg, rgba(168,85,247,0.15), rgba(168,85,247,0.05)); border: 1px solid rgba(168,85,247,0.3); border-radius: 20px; padding: 24px; margin-bottom: 16px; box-shadow: 0 4px 16px rgba(168,85,247,0.1); animation-delay: 0.3s;">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                    <div style="font-size: 48px;">👑</div>
                    <div style="flex: 1;">
                        <h4 style="color: #a855f7; font-size: 22px; font-weight: 800; margin: 0 0 4px 0;">Grand Leader</h4>
                        <p style="color: #94a3b8; font-size: 13px; margin: 0;">Master Level</p>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px;">
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Required</p>
                        <p style="color: #a855f7; font-size: 24px; font-weight: 800; margin: 0;">100 Active</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Bonus</p>
                        <p style="color: #a855f7; font-size: 24px; font-weight: 800; margin: 0;">$150</p>
                    </div>
                    <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 14px; text-align: center;">
                        <p style="color: #64748b; font-size: 11px; margin: 0 0 6px 0; text-transform: uppercase; letter-spacing: 0.5px;">Weekly</p>
                        <p style="color: #22c55e; font-size: 24px; font-weight: 800; margin: 0;">$50</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Commission Structure -->
        <div class="section" style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(56,189,248,0.15); border-radius: 20px; padding: 24px; margin-bottom: 20px; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#38bdf8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="1" x2="12" y2="23"/>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
                <h3 style="color: #38bdf8; font-size: 20px; font-weight: 700; margin: 0;">Commission Structure</h3>
            </div>
            <p style="color: #94a3b8; font-size: 14px; margin: 0 0 16px 0;">Earn from deposits across 3 levels:</p>
            <div style="display: grid; gap: 12px;">
                <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.25); border-radius: 12px; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="color: #22c55e; font-size: 16px; font-weight: 700; margin: 0 0 4px 0;">Level 1</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">Direct Referrals</p>
                    </div>
                    <p style="color: #22c55e; font-size: 28px; font-weight: 900; margin: 0;">2%</p>
                </div>
                <div style="background: rgba(56,189,248,0.1); border: 1px solid rgba(56,189,248,0.25); border-radius: 12px; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="color: #38bdf8; font-size: 16px; font-weight: 700; margin: 0 0 4px 0;">Level 2</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">2nd Generation</p>
                    </div>
                    <p style="color: #38bdf8; font-size: 28px; font-weight: 900; margin: 0;">1%</p>
                </div>
                <div style="background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.25); border-radius: 12px; padding: 16px; display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p style="color: #a855f7; font-size: 16px; font-weight: 700; margin: 0 0 4px 0;">Level 3</p>
                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">3rd Generation</p>
                    </div>
                    <p style="color: #a855f7; font-size: 28px; font-weight: 900; margin: 0;">0.5%</p>
                </div>
            </div>
        </div>

        <!-- Example -->
        <div class="section" style="background: linear-gradient(135deg, rgba(168,85,247,0.15), rgba(168,85,247,0.05)); border: 1px solid rgba(168,85,247,0.3); border-radius: 20px; padding: 24px; margin-bottom: 20px; box-shadow: 0 4px 16px rgba(168,85,247,0.1);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#a855f7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                <h3 style="color: #a855f7; font-size: 20px; font-weight: 700; margin: 0;">Example Calculation</h3>
            </div>
            <div style="background: rgba(0,0,0,0.2); border-radius: 12px; padding: 16px; margin-bottom: 12px;">
                <p style="color: #e5e7eb; font-size: 14px; font-weight: 700; margin: 0 0 12px 0;">Scenario: 15 Active Members</p>
                <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.8;">
                    • 6 active in Level 1<br>
                    • 7 active in Level 2<br>
                    • 2 active in Level 3<br>
                    <strong style="color: #e5e7eb;">Total: 15 active members</strong>
                </p>
            </div>
            <div style="background: rgba(56,189,248,0.2); border: 1px solid rgba(56,189,248,0.3); border-radius: 12px; padding: 16px;">
                <p style="color: #38bdf8; font-size: 16px; font-weight: 700; margin: 0 0 8px 0;">✓ Elite Leader Qualified!</p>
                <p style="color: #94a3b8; font-size: 13px; margin: 0; line-height: 1.8;">
                    • $5 bonus (Junior - claimed)<br>
                    • $20 bonus (Elite - one-time)<br>
                    • $10 every Monday<br>
                    • Plus ongoing commissions
                </p>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="section" style="background: linear-gradient(135deg, rgba(15,23,42,0.9), rgba(30,41,59,0.9)); border: 1px solid rgba(56,189,248,0.15); border-radius: 20px; padding: 24px; box-shadow: 0 4px 16px rgba(0,0,0,0.2);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    <line x1="12" y1="9" x2="12" y2="13"/>
                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                </svg>
                <h3 style="color: #fbbf24; font-size: 20px; font-weight: 700; margin: 0;">Important Notes</h3>
            </div>
            <div style="display: grid; gap: 12px;">
                <div style="display: flex; gap: 12px;">
                    <span style="color: #22c55e; font-size: 18px; flex-shrink: 0;">✓</span>
                    <p style="color: #94a3b8; font-size: 14px; margin: 0;">Bonuses paid once per rank when achieved</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <span style="color: #22c55e; font-size: 18px; flex-shrink: 0;">✓</span>
                    <p style="color: #94a3b8; font-size: 14px; margin: 0;">Weekly salary paid every Monday automatically</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <span style="color: #22c55e; font-size: 18px; flex-shrink: 0;">✓</span>
                    <p style="color: #94a3b8; font-size: 14px; margin: 0;">Ranks are permanent - never downgrade</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <span style="color: #22c55e; font-size: 18px; flex-shrink: 0;">✓</span>
                    <p style="color: #94a3b8; font-size: 14px; margin: 0;">Commissions credited when deposits complete</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
