<div class="header-style2 fixed-top"
    style="
        background: linear-gradient(135deg, #020617, #0f172a);
        border-bottom: 1px solid rgba(56,189,248,0.2);
        backdrop-filter: blur(10px);
        padding: 12px 16px;
        z-index: 1000;
     ">

    <div class="d-flex justify-content-between align-items-center gap-14">

        {{-- USER INFO --}}
        <div class="d-flex align-items-center gap-12" style="flex: 1;">

            <div style="
                width: 44px;
                height: 44px;
                border-radius: 10px;
                overflow: hidden;
                border: 1.5px solid rgba(56,189,248,0.3);
                box-shadow: 0 0 15px rgba(56,189,248,0.2), inset 0 0 10px rgba(56,189,248,0.1);
                background: linear-gradient(135deg, rgba(56,189,248,0.1), rgba(34,197,94,0.05));
            ">
                <img src="{{ asset('images/avt/avt2.jpg') }}"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            <div>
                <strong style="
                    color: #e5e7eb;
                    font-size: 13px;
                    line-height: 1.2;
                    display: block;
                ">
                    {{ auth()->user()->name }}
                </strong>

                <small style="
                    color: #64748b;
                    font-size: 11px;
                    display: block;
                    margin-top: 2px;
                ">
                    {{ auth()->user()->email }}
                </small>
            </div>

        </div>

        {{-- NOTIFICATION & SETTINGS ICONS --}}
        <div class="d-flex align-items-center gap-10">

            <!-- NOTIFICATIONS -->
            <div style="position: relative;">
                <button onclick="toggleNotifications()"
                    style="
                        width: 40px;
                        height: 40px;
                        background: linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%);
                        border: 1px solid rgba(56,189,248,0.2);
                        border-radius: 8px;
                        color: #38bdf8;
                        font-size: 18px;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    "
                    onmouseover="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.15) 0%, rgba(56,189,248,0.1) 100%)'; this.style.borderColor='rgba(56,189,248,0.4)'; this.style.boxShadow='0 0 15px rgba(56,189,248,0.2)';"
                    onmouseout="this.style.background='linear-gradient(135deg, rgba(56,189,248,0.1) 0%, rgba(56,189,248,0.05) 100%)'; this.style.borderColor='rgba(56,189,248,0.2)'; this.style.boxShadow='none';">
                    🔔
                </button>
                <span style="
                    position: absolute;
                    top: 6px;
                    right: 6px;
                    width: 8px;
                    height: 8px;
                    background: #ef4444;
                    border-radius: 50%;
                    border: 2px solid #020617;
                    box-shadow: 0 0 8px rgba(239,68,68,0.6);
                "></span>
            </div>

            <!-- SETTINGS -->
            <a href="{{ route('account.settings') }}"
                style="
                    width: 40px;
                    height: 40px;
                    background: linear-gradient(135deg, rgba(168,85,247,0.1) 0%, rgba(168,85,247,0.05) 100%);
                    border: 1px solid rgba(168,85,247,0.2);
                    border-radius: 8px;
                    color: #a855f7;
                    font-size: 18px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-decoration: none;
                "
                onmouseover="this.style.background='linear-gradient(135deg, rgba(168,85,247,0.15) 0%, rgba(168,85,247,0.1) 100%)'; this.style.borderColor='rgba(168,85,247,0.4)'; this.style.boxShadow='0 0 15px rgba(168,85,247,0.2)';"
                onmouseout="this.style.background='linear-gradient(135deg, rgba(168,85,247,0.1) 0%, rgba(168,85,247,0.05) 100%)'; this.style.borderColor='rgba(168,85,247,0.2)'; this.style.boxShadow='none';">
                ⚙️
            </a>

        </div>

    </div>
</div>

<script>
    function toggleNotifications() {
        Swal.fire({
            title: '🔔 Notifications',
            html: `
                <div style="text-align: left; color: #e5e7eb;">
                    <div style="padding: 12px; background: rgba(56,189,248,0.1); border-left: 3px solid #38bdf8; border-radius: 4px; margin-bottom: 8px;">
                        <p style="margin: 0 0 4px 0; font-weight: 600; font-size: 13px;">Order Completed</p>
                        <p style="margin: 0; font-size: 12px; color: #94a3b8;">Your compute order #1234 completed successfully</p>
                        <p style="margin: 4px 0 0 0; font-size: 11px; color: #64748b;">2 hours ago</p>
                    </div>
                    <div style="padding: 12px; background: rgba(34,197,94,0.1); border-left: 3px solid #22c55e; border-radius: 4px;">
                        <p style="margin: 0 0 4px 0; font-weight: 600; font-size: 13px;">Withdrawal Approved</p>
                        <p style="margin: 0; font-size: 12px; color: #94a3b8;">Your withdrawal request has been approved and will be processed soon</p>
                        <p style="margin: 4px 0 0 0; font-size: 11px; color: #64748b;">5 hours ago</p>
                    </div>
                </div>
            `,
            icon: 'info',
            confirmButtonColor: '#38bdf8',
            background: '#020617',
            color: '#e5e7eb',
            customClass: {
                popup: 'swal-dark-popup'
            }
        });
    }
</script>

<style>
    .swal-dark-popup {
        background: linear-gradient(135deg, #0f172a 0%, #020617 100%) !important;
        border: 1px solid rgba(56, 189, 248, 0.2) !important;
    }
</style>